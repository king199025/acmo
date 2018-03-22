<?php

namespace frontend\modules\mainpage\controllers;

use backend\modules\region\models\Region;
use common\classes\Debug;
use common\models\AcmoApi;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Cookie;

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

        if (($pdk_id = \Yii::$app->session->get('pdk_id')) || ($pdk_id = \Yii::$app->request->cookies->getValue('pdk_id'))) {
            $region = Region::findOne($pdk_id);
            $api = AcmoApi::get($region)->getCacheData();

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
        } else {
            return $this->render('index');
        }
    }

    public function actionSetPdk()
    {
        if ($pdk_id = \Yii::$app->request->post('region_id')) {
            \Yii::$app->session->set('pdk_id', $pdk_id);
            \Yii::$app->response->cookies->add(new Cookie([
                'name' => 'pdk_id',
                'value' => $pdk_id,
                'expire' => 2
            ]));

            return $this->redirect('/');
        }
    }
}
