<?php

namespace frontend\modules\mainpage\controllers;

use backend\modules\region\models\Region;
use common\classes\Debug;
use common\models\AcmoApi;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `mainpage` module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     * @throws \yii\base\InvalidParamException
     */
    public function actionIndex()
    {
        $popupWindow = [];
        $api = AcmoApi::get(1)->getCacheData();

        foreach ($api->meteo as &$item){
            $popupWindow[] = [
                'name' => $item['METEO_NAME'],
                'lat' => $item['latitude'],
                'lon' => $item['longitude'],
                'temperature' => $item['T'],
                'render' => $this->renderPartial('_popup_window', [
                    'meteo' => $api->meteo[$item['METEO_ID']],
                    'forecast' => $api->getForecastInterval($item['METEO_ID'], 4),
                    'photo' => $api->photo[$item['METEO_ID']],
                    'traffic' => $api->traffic[$item['METEO_ID']],
                ]),
            ];
        }

        return $this->render('index', [
            'popupWindow' => $popupWindow
        ]);
    }

    /**
     * @param $region_id
     * @param $type
     * @param $data
     * @return mixed|null
     */
    protected function getData($region_id, $type, $data)
    {
        if($region = Region::findOne($region_id)){
            return AcmoApi::get($region->url)->getData($type, $data);
        }
        return null;
    }

    protected function getModelApi($region_id)
    {
        if($region = Region::findOne($region_id)){
            return AcmoApi::get($region->url);
        }

        return null;
    }
}
