<?php

namespace frontend\modules\chart\controllers;

use common\classes\Debug;
use common\models\AcmoApi;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `chart` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionMeteo($id)
    {
        $api = AcmoApi::get(1)->getCacheData();

        $x = ArrayHelper::getColumn($api->forecast[$id], 'WEATHER_DATE');

        return $this->render('meteo-chart', [
            'forecast' => $api->forecast[$id],
            'name' => $api->names[$id],
            'next' => $api->getNextId($id),
            'prev' => $api->getPrevId($id),
            'x' => $x]);
    }

    public function actionTraffic($id)
    {
        $api = AcmoApi::get(1);
        $api->getTrafficByDay($id);

        foreach ($api->traffic as $traffic ){
            $statistic[] = [
                'date' => $traffic[0]['TM_DATE'],
                'Car' => $traffic[0]['Car'] + $traffic[1]['Car'],
                'Bus' => $traffic[0]['Bus'] + $traffic[1]['Bus'],
                'Struck' => $traffic[0]['STruck'] + $traffic[1]['STruck'],
                'MTruck' => $traffic[0]['MTruck'] + $traffic[1]['MTruck'],
                'LTruck' => $traffic[0]['LTruck'] + $traffic[1]['LTruck'],
                'BTruck' => $traffic[0]['BTruck'] + $traffic[1]['BTruck']

            ];
        }

        return $this->render('traffic-chart', [
            'statistic' => $statistic,
            'name' => $api->names[$id],
            'next' => $api->getNextId($id),
            'prev' => $api->getPrevId($id),
        ]);
    }
}
