<?php
/**
 * Created by PhpStorm.
 * User: Тоха
 * Date: 12.12.2017
 * Time: 16:12
 */

namespace frontend\modules\weather\controllers;


use common\classes\Debug;
use frontend\modules\weather\models\Forecast;
use yii\web\Controller;

class ForecastController extends Controller
{
    public function actionIndex($id, $date = null)
    {
        $api = Forecast::get(1);
        $forecast = $api->getForecast($id, $date);

        return $this->render('index', [
            'render' => $this->_getRender($forecast),
            'id' => $id,
            'name' => $forecast[0]['METEO_NAME'],
            'prev' => $api->getPrevId($id),
            'next' => $api->getNextId($id)
        ]);
    }

    /*public function actionArchive($id, $date)
    {
        $forecast = Forecast::get(1)->getForecast($id, $date);

        return $this->render('index', [
            'render' => $this->_getRender($forecast),
            'id' => $id,
            'name' => $forecast[0]['METEO_NAME']
        ]);
    }

    public function actionFuture($id, $date)
    {
        $forecast = Forecast::get(1)->getForecast($id, $date);

        return $this->render('index', [
            'render' => $this->_getRender($forecast),
            'id' => $id,
            'name' => $forecast[0]['METEO_NAME']
        ]);
    }*/

    private function _getRender($forecast)
    {
        return $this->renderPartial('/ajax/_date_interval_table', ['weather' => $forecast]);
    }

}