<?php

namespace frontend\modules\mainpage\controllers;

use backend\modules\region\models\Region;
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
        $weather = $this->getData(1, 'meteo', ['date' => date('d-m-Y', time())]);

        foreach ((array)$weather['WEATHER_DATA'] as &$item){
            AcmoApi::check($item);
            $popupWindow[] = [
                'name' => $item['METEO_NAME'],
                'lat' => $item['latitude'],
                'lon' => $item['longitude'],
                'render' => $this->renderPartial('_popup_window', ['item' => $item]),
            ];
        }

        return $this->render('index', [
            'popupWindow' => $popupWindow
        ]);
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
