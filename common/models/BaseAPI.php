<?php
/**
 * Created by PhpStorm.
 * User: Антон
 * Date: 31.10.2017
 * Time: 19:17
 */

namespace common\models;

use common\classes\Debug;
use console\models\ConsoleApi;
use yii\db\Exception;

/**
 * Class BaseAPI
 * @package common\models
 */
class BaseAPI
{
    const USER_LOGIN = 'taranishin';
    const USER_PASSWORD = 'taranishin';
    const DATE_FORMAT = 'd-m-Y H:i';
    public $url = '';
    public $img_path = '';
    public $no_image = '/img/default-no-image.png';
    protected $id;

    //Состояние поверхности
    public static $road_state = [
        1 => 'Сухо',
        2 => 'Влажно',
        3 => 'Мокро',
        4 => 'Иней',
        5 => 'Снег',
        6 => 'Лед'
    ];

    public static $road_state_color = [
        1 => 'green',
        2 => '#7FFF00',
        3 => 'blue',
        4 => '#8B008B',
        5 => '#FFFF00',
        6 => 'red'
    ];
    //Явления погоды
    public static $weather = [
        1 => ['name' => 'Ясно', 'img' => 'sunny.png'],
        4 => ['name' => 'Облачно', 'img' => 'clouds.png'],
        10 => ['name' => 'Дождь', 'img' => 'rain.png'],
        12 => ['name' => 'Дождь со снегом', 'img' => 'weather.png'],
        13 => ['name' => 'Снег', 'img' => 'snowflake.png'],
        20 => ['name' => 'Град', 'img' => 'hail.png']
    ];
    //Тип осадков
    public static $prec_type = [
        0 => 'Нет',
        1 => 'Дождь',
        2 => 'Дождь со снегом',
        3 => 'Снег',
        4 => 'Град'
    ];
    //Допустимые типы запросов
    public $requestType = [
        'meteo',
        'video',
        'videolist',
        'videobyid',
        'forecast',
        'forecasta',
        'tm',
        'event'
    ];


    public function __construct(Region $region)
    {
        $this->url = $region->url;
        $this->id = $region->id;

        $this->img_path = \Yii::getAlias('@img_api');
    }

    public static function getClass()
    {
        return get_called_class();
    }

    /**
     * @param $url
     * @return AcmoApi|ConsoleApi|BaseAPI
     */
    public static function get($url)
    {
        $class = self::getClass();
        return new $class($url);
    }

    /**
     * @param $type
     * @param $data
     * @return mixed|null
     * @throws Exception
     */
    public function getData($type, $data)
    {
        if(in_array($type, $this->requestType)){
            if($type !== 'video' && $type !== 'videobyid'){
                $result = $this->sendRequest($this->getRequest($data, $type));
            }else $result = $this->sendRequestVideo($this->getRequest($data, $type));

            if(is_array($result)){
                self::check($result);
            }

            return (!empty($result)) ? $result : null;
        }
        throw new Exception('Invalid request type', 404);
    }

    /**
     * @param $img
     * @return string
     */
    public function getWebImgUrl($img)
    {
        return \Yii::getAlias('@web_img_api') . '/' . $img;
    }

    /**
     * Метод построения строки запроса на основании полученного массива данных
     * @param $data
     * @param $type
     * @return bool|string
     */
    public function getRequest($data, $type)
    {
        $request = '?type=' . strtolower(str_replace('get', '', $type));

        if (is_array($data) && !empty($data)) {
            foreach ($data as $key => $value) {
                $request .= '&' . $key . '=' . $value;
            }
            return str_replace(' ', '%20', $this->url . $request . $this->getDataToAutentificate());
        }

        return false;
    }

    /**
     * @param $requestString
     * @return mixed|null
     */
    public function sendRequest($requestString)
    {
        if(!empty($requestString)){
            return json_decode(json_encode(simplexml_load_file($requestString)), true);
        }
        return null;
    }

    /**
     * @param $requestString
     * @return null|string
     */
    public function sendRequestVideo($requestString)
    {
        $file =  uniqid() . '.jpeg';
        $path = $this->img_path . '/' . $file;
        $upload = file_get_contents($requestString);

        if(!empty($upload)){
            file_put_contents($path, $upload);
            if(is_file($path)){
                return $this->getWebImgUrl($file);
            }else return null;
        }else return $this->no_image;
    }

    /**
     * Метод получения данных для аутентификации, вставляемых в запрос
     * @return string
     */
    public function getDataToAutentificate()
    {
        return '&user=' . self::USER_LOGIN . '&password=' . self::USER_PASSWORD;
    }

    /**
     * @param $array
     */
    public static function check(&$array)
    {
        if(is_array(current($array))){
            $array = current($array);

        }

        foreach ($array as &$item){
            if(empty($item)){
                $item = '';
            }elseif(is_array($item)){
                self::check($item);
            }
        }
    }

    /**
     * @param $name
     * @return array
     */
    public static function parsePdkName($name){
        $parse = '';
        $result = [];

        if(is_string($name)){
            $name = str_replace('км', 'км ', $name);
            $name = preg_replace("/  +/", " ", trim($name));
            $parse = explode(' ', $name);
            $result['id'] = $parse[0];
            if(strpos($parse[1], 'км') !== false){
                if(strpos($parse[2], '+')!== false){
                    $result['distance'] = implode([$parse[1], $parse[2]], ' ');
                }elseif(strlen($parse[2] > 2)){
                    $result['distance'] = $parse[2];
                }elseif(strlen($parse[1] > 2)){
                    $result['distance'] = $parse[1];
                }

                if (!empty($parse[3]) && !empty($parse[4])){
                    $result['name'] = implode([$parse[3], $parse[4]], ' ');
                }elseif (!empty($parse[3])){
                    $result['name'] = $parse[3];
                }
            }else {
                if(!empty($parse[1]) && !empty($parse[2])){
                    $result['name'] = implode([$parse[1], $parse[2]], ' ');
                }elseif (!empty($parse[1])){
                    $result['name'] = $parse[1];
                }
            }
        }
        if(empty($result['distance'])){
            $result['distance'] = '';
        }

        return $result;
    }
}