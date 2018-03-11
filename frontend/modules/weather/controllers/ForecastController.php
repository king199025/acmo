<?php
/**
 * Created by PhpStorm.
 * User: Тоха
 * Date: 12.12.2017
 * Time: 16:12
 */

namespace frontend\modules\weather\controllers;


use common\classes\Debug;
use common\models\AcmoApi;
use common\models\BaseAPI;
use frontend\modules\weather\models\Forecast;
use yii\web\Controller;

class ForecastController extends Controller
{
    public function actionIndex($id)
    {
        $api = AcmoApi::get(1)->getCacheData();
        $date = date(BaseAPI::DATE_FORMAT);
        $forecast = Forecast::get(1)->getForecast($id, $date);

        return $this->render('index', [
            'forecast' => $forecast[0],
            'photo' => $api->photo[$id],
            'prev' => $api->getPrevId($id),
            'next' => $api->getNextId($id)
        ]);
    }

    public function actionView($id, $date = null)
    {
        $api = Forecast::get(1);
        $forecast = $api->getForecast($id, $date);

        return $this->render('view', [
            'render' => $this->_getRender($forecast),
            'id' => $id,
            'name' => $api->names[$id],
            'prev' => $api->getPrevId($id),
            'next' => $api->getNextId($id)
        ]);
    }

    private function _getRender($forecast)
    {
        return $this->renderPartial('/ajax/_date_interval_table', ['weather' => $forecast]);
    }

}