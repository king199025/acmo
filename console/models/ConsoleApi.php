<?php
/**
 * Created by PhpStorm.
 * User: Антон
 * Date: 04.11.2017
 * Time: 18:07
 */

namespace console\models;


use common\models\AcmoApi;

class ConsoleApi extends AcmoApi
{
    public function __construct($url)
    {
        parent::__construct($url);
    }

    public function getAllVideo()
    {
        $key = 'photo_api_' . date('d-m-Y H', strtotime($this->date));

        if (!empty($this->names)) {
            foreach (array_keys($this->names) as $id) {
                $this->getVideoByVideoList($id);
            }
        }

        \Yii::$app->cache->set($key, $this->photo, 86400);

        if ($cache = \Yii::$app->cache->get($key)){
            return true;
        }else return false;
    }
}