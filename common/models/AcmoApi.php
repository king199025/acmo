<?php

namespace common\models;

use common\classes\Debug;
use yii\caching\FileCache;
use yii\helpers\ArrayHelper;
use yii\web\Session;


/**
 * Класс для работы с API ACMO
 * Class AcmoApi
 * @package backend\models
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

        $this->date = date(self::DATE_FORMAT, time());
        $this->meteo = $this->getData('meteo', ['date' => $this->date]);
        $this->meteo = ArrayHelper::index($this->meteo, 'METEO_ID');
        $this->names = $this->getPdkId($this->meteo);

    }

    public function getVideoByVideoList($pdk_id)
    {
        if (empty($this->videolist)) {
            $this->videolist = $this->getVideoList();
        }

        if (!empty($this->videolist[$pdk_id]) && is_array($this->videolist[$pdk_id])) {

            foreach ($this->videolist[$pdk_id] as $video) {
                $this->photo[$pdk_id][] = $this->getData('videobyid', [
                    'id' => (isset($video['id'])) ? $video['id'] : 0
                ]);
            }
        }

        if (!empty($result)) {
            return $result;
        }
        return null;
    }

    /**
     *
     */
    public function getAllVideo()
    {
        $key = 'photo_api_' . date('d-m-Y H', strtotime($this->date));
        $cache1 = new FileCache();

        if ($cache = \Yii::$app->cache->get($key)) {
            $this->photo = $cache;
            $cache1->set($key, $this->photo);
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

    public function getTrafficById($id, $date = null)
    {
        if ($date === null) {
            $date = $this->date;
        }

        $this->traffic = $this->getData('tm', ['date' => $date, 'id' => $id]);
    }

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

    public function getAllTraffic()
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
        return $traffic['Struck'] + $traffic['Mtruck'] + $traffic['Ltruck'] + $traffic['Btruck'];
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
    }

    public function getPrevId($id)
    {
        $ids = array_keys($this->names);
        $key = array_search($id, $ids);

        if ($key !== 0) {
            $this->prevId = $ids[$key - 1];
        } else $this->prevId = $ids[count($ids) - 1];
    }

    /**
     * @param $id
     */
    public function getNextPrevIds($id)
    {
        $this->getNextId($id);
        $this->getPrevId($id);
    }

    public function getForecast($id, $interval = 1, $count = 4, $date = null)
    {
        if ($date === null) {
            $date = $this->date;
        }

        $result = $this->getData('forecasta', ['id' => $id, 'date' => $date]);

        if ($interval === 1) {
            return $result;
        } else {
            return $result = $this->forecastInterval($result, $interval, $count);
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