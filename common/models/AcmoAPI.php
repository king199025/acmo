<?php

namespace common\models;

use common\classes\Debug;
use yii\db\Exception;

/**
 * Класс для работы с API ACMO
 * Class AcmoApi
 * @package backend\models
 */
class AcmoApi extends BaseAPI
{
    public $url = '';
    const USER_LOGIN = 'taranishin';
    const USER_PASSWORD = 'taranishin';
    //Состояние поверхности
    public static $road_state = [
        1 => 'Сухо',
        2 => 'Влажно',
        3 => 'Мокро',
        4 => 'Иней',
        5 => 'Снег',
        6 => 'Лед'
    ];
    //Явления погоды
    public static $weather = [
        1 => 'Ясно',
        4 => 'Облачно',
        10 => 'Дождь',
        12 => 'Дождь со снегом',
        13 => 'Снег',
        20 => 'Град'
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

    public function __construct($url)
    {
        $this->url = $url;
    }

    public static function get($url)
    {
        return new self($url);
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
            return $this->sendRequest($this->getRequest($data, $type));
        }
        throw new Exception('Invalid request type', 404);
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
            return $this->url . $request . $this->getDataToAutentificate();
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
     * Метод получения данных для аутентификации, вставляемых в запрос
     * @return string
     */
    public function getDataToAutentificate()
    {
        return '&user=' . self::USER_LOGIN . '&password=' . self::USER_PASSWORD;
    }
}