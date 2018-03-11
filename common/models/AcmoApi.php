<?php

namespace common\models;

use common\classes\Debug;
use yii\caching\FileCache;
use yii\helpers\ArrayHelper;
use yii\httpclient\Exception;
use yii\web\Session;


/**
 * Class AcmoApi
 * @package common\models
 */
class AcmoApi extends BaseAPI
{
    public $meteo = [];
    public $names = [];
    public $date;
    public $videolist = [];
    public $photo = [];
    public $forecast = [];
    public $traffic = [];
    public $nextId = '';
    public $prevId = '';


    public function __construct($url)
    {
        parent::__construct($url);
        $this->_init();
    }

    protected function _init()
    {
        $this->date = date(self::DATE_FORMAT, time());
        $this->meteo = $this->getData('meteo', ['date' => $this->date]);
        $this->meteo = ArrayHelper::index($this->meteo, 'METEO_ID');
        $this->names = $this->getPdkId($this->meteo);
    }

    /**
     * получение данных из кэша
     * @return mixed
     * @throws Exception
     */
    public function getCacheData()
    {
        $key = 'api_object_' . date('d-m-Y H', strtotime($this->date));

        if($cache = \Yii::$app->cache->get($key)){
            return $cache;
        }else {
            if($this->setCacheData($key)){
                $this->getCacheData();
            }else throw new Exception('Caching Error', 404);
        }
    }

    /**
     * Запись данных в кэш
     * @param null $key
     * @return bool
     */
    public function setCacheData($key = null){
        if($key === null) {
            $key = 'api_object_' . date('d-m-Y H', strtotime($this->date));
        }

        $this->getAllVideo();
        $this->setAllTraffic();
        $this->getAllForecast();

        \Yii::$app->cache->set($key, $this, 86400);

        if(\Yii::$app->cache->get($key)) {
            return true;
        }else return false;
    }

    /**
     * Метод получает список доступных фото данной ПДК
     * @param $pdk_id
     * @return null|$result
     */
    public function getVideoByVideoList($pdk_id, $date = null)
    {
        if (empty($this->videolist)) {
            $this->videolist = $this->getVideoList($date);
        }

        if (!empty($this->videolist[$pdk_id]) && is_array($this->videolist[$pdk_id])) {

            foreach ($this->videolist[$pdk_id] as $video) {
                if (is_array($video)) {
                    $video['url'] = $this->getData('videobyid', [
                        'id' => $video['id'],
                    ]);
                } else {
                    $video = [
                        'url' => $this->no_image,
                        'date' => date('d.m.Y H:i:s')
                    ];
                }

                $this->photo[$pdk_id][] = $video;
            }
        }

        if (!empty($this->photo[$pdk_id])) {
            return $this->photo[$pdk_id];
        }
        return null;
    }

    /**
     * Получение всех изображений по всем метео точкам
     * @return array|mixed
     */
    public function getAllVideo()
    {
        $key = 'photo_api_' . date('d-m-Y H', strtotime($this->date));

        if ($cache = \Yii::$app->cache->get($key)) {
            $this->photo = $cache;

            return $this->photo;
        }

        if (!empty($this->names)) {
            foreach (array_keys($this->names) as $id) {
                $this->getVideoByVideoList($id);
            }
        }

        \Yii::$app->cache->set($key, $this->photo, 86400);

        return $this->photo;
    }

    /**
     * @param null $date
     * @return array|null
     */
    public function getVideoList($date = null)
    {
        if ($date === null) {
            $date = $this->date;
        }

        $ids = array_keys($this->meteo);

        foreach ($ids as $id) {
            $this->videolist[$id] = $this->getData('videolist', ['id' => $id, 'date' => $date]);
        }


        if (!empty($this->videolist)) {
            return $this->videolist;
        }
        return null;
    }

    /**
     * Получение траффика по id
     * @param $id
     * @param null $date
     */
    public function getTrafficById($id, $date = null)
    {
        if ($date === null) {
            $date = $this->date;
        }

        $this->traffic = $this->getData('tm', ['date' => $date, 'id' => $id]);
    }

    /**
     * Получение архива траффика по id
     * @param $id
     * @param null $date
     */
    public function getTrafficArchive($id, $date = null)
    {
        if ($date === null) {
            $date = $this->date;
        }
        $startDate = $date;

        $i = 0;
        while ($traffic = $this->getData('tm', ['date' => $startDate, 'id' => $id])) {
            $i++;
            $this->traffic[] = $traffic;
            $startDate = date(self::DATE_FORMAT, strtotime($date) - 86400 * $i);

            if ($i > 8) break;
        }

        $this->checkTraffic($this->traffic);
    }

    /**
     * Установка всего трафика в свойство traffic
     */
    public function setAllTraffic()
    {
        $pdk_id = array_keys($this->names);

        foreach ($pdk_id as $id) {
            $this->traffic[$id] = $this->getData('tm', ['date' => $this->date, 'id' => $id]);
        }

        $this->checkTraffic($this->traffic);
    }

    public function getPdkId(array $meteo)
    {
        if (!empty($meteo)) {
            return ArrayHelper::map($meteo, 'METEO_ID', 'METEO_NAME');
        }
    }

    public static function getTrucksCount($traffic)
    {
        if(isset($traffic['Struck'], $traffic['Mtruck'], $traffic['Ltruck'], $traffic['Btruck'])){
            return $traffic['Struck'] + $traffic['Mtruck'] + $traffic['Ltruck'] + $traffic['Btruck'];
        }else return 0;
    }

    public function getTrafficByDay($id, $date = null)
    {
        if($date === null) {
            $date = date('d-m-Y 00:00:00', strtotime($this->date));
        }else $date = date('d-m-Y 00:00:00', strtotime($date));

        while (strtotime($date) < time()) {
            $this->traffic[] = $this->getData('tm', ['id' => $id, 'date' => $date]);
            $date = date('d-m-Y H:i:s', strtotime($date) + 3600);
            //break;
        }

    }

    public function checkTraffic($traffic)
    {
        $this->traffic = array_filter($traffic, function ($item) {
            if (is_array($item[0])) {
                return true;
            }
            return false;
        });
    }

    public function getNextId($id)
    {
        $ids = array_keys($this->names);
        $key = array_search($id, $ids);

        if ($key !== count($ids) - 1) {
            $this->nextId = $ids[$key + 1];
        } else $this->nextId = $ids[0];
        return $this->nextId;
    }

    public function getPrevId($id)
    {
        $ids = array_keys($this->names);
        $key = array_search($id, $ids);

        if ($key !== 0) {
            $this->prevId = $ids[$key - 1];
        } elseif($key !== false) {
            $this->prevId = $ids[count($ids) - 1];
        } else throw new Exception('Invalid parameter id', 500);
        return $this->prevId;
    }

    /**
     * @param $id
     */
    public function getNextPrevIds($id)
    {
        $this->getNextId($id);
        $this->getPrevId($id);
    }

    public function getForecastInterval($id, $interval = 1, $count = 4)
    {
        if(!empty($this->forecast[$id])){
            if ($interval === 1) {
                return $this->forecast[$id];
            } else {
                return $result = $this->forecastInterval($this->forecast[$id], $interval, $count);
            }
        }


    }

    public function getAllForecast($date = null)
    {
        if ($date === null) {
            $date = $this->date;
        }

        $forecasts = $this->getData('forecasta', ['date' => date('d-m-Y 00:00:00', strtotime($date) - 86400)]);

        foreach ($forecasts as $forecast) {
            $this->forecast[$forecast['METEO_ID']][] = $forecast;
        }
    }

    public function forecastInterval($forecast, $interval, $count = null)
    {
        $result[] = $forecast[0];
        $time = $interval * 3600;
        $firstTime = strtotime($forecast[0]['WEATHER_DATE']);

        foreach ($forecast as $key => $item) {
            $forecastTime = strtotime($item['WEATHER_DATE']);

            if ($firstTime + $time === $forecastTime) {
                $firstTime = strtotime($item['WEATHER_DATE']);
                $result[] = $item;
            }

            if (count($result) >= $count) {
                break;
            }
        }

        return $result;
    }
}