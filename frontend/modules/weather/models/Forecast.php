<?php
/**
 * Created by PhpStorm.
 * User: Тоха
 * Date: 12.12.2017
 * Time: 16:19
 */

namespace frontend\modules\weather\models;


use common\models\AcmoApi;

class Forecast extends AcmoApi
{
    public function __construct($url)
    {
        parent::__construct($url);
    }

    public function getForecast($pdk_id, $date = null)
    {
        if($date === null){
            $date = date('d.m.Y 00:00', strtotime($this->date));
        }

        return $this->getData('forecasta', [
            'id' => $pdk_id,
            'date' => $date,
            'last' => 2880
        ]);
    }
}