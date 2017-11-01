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
        $weather = $this->getData(1, 'meteo', ['date' => date('d-m-Y', time())]);

        foreach ($weather['WEATHER_DATA'] as &$item){
            AcmoApi::check($item);
            $item['METEO_NAME'] = AcmoApi::parsePdkName($item['METEO_NAME']);
            $popupWindow[] = [
                'name' => implode($item['METEO_NAME'], ' '),
                'lat' => $item['latitude'],
                'lon' => $item['longitude'],
                'render' => $this->renderPartial('_popup_window', ['item' => $item]),
            ];
        }

        return $this->render('index', [
            'weather' => $weather,
            'popupWindow' => $popupWindow
        ]);
    }

    public function actionView($id)
    {
        $weather = $this->getData(1,'forecasta', ['date' => date('d-m-Y', time()), 'id' => $id]);

        if(!empty($weather['WEATHER_DATA'])){
            $render = $this->renderPartial('/ajax/_date_interval_table', ['weather' => $weather]);

            return $this->render('view', ['render' => $render, 'name' => $weather['WEATHER_DATA'][0]['METEO_NAME']]);
        }
        return $this->render('view', ['render' => '<h1>Ничего не найдено</h1>']);

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
