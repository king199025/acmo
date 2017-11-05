<?php

namespace frontend\modules\weather\controllers;

use common\classes\Debug;
use common\models\AcmoApi;
use common\models\Region;
use yii\web\Controller;

/**
 * Default controller for the `weather` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $popupWindow = [];
        $api = AcmoApi::get(1);

        return $this->render('index', [
            'weather' => $api->meteo,
            'popupWindow' => $popupWindow
        ]);
    }

    public function actionView($id)
    {
        $weather = $this->getData(1,'forecasta', ['date' => date('d-m-Y', time()), 'id' => $id]);

        if(!empty($weather)){
            $render = $this->renderPartial('/ajax/_date_interval_table', ['weather' => $weather]);

            return $this->render('view', [
                'render' => $render,
                'name' => $weather[0]['METEO_NAME'],
                'id' => $id
                ]);
        }

        return $this->render('view', ['render' => '<h1>Ничего не найдено</h1>', 'id' => $id]);

    }

    /**
     * @param $id
     * @param $type
     * @param $data
     * @return mixed|null
     */
    protected function getData($id, $type, $data)
    {
        if($region = Region::findOne($id)){
            return AcmoApi::get($region->url)->getData($type, $data);
        }
        return null;
    }
}
