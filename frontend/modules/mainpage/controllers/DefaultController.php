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
        $date = str_replace(' ', '%20', date('d-m-Y H:i:s', time()));
        $popupWindow = [];
        $weather = $this->getData(1, 'meteo', ['date' => $date]);

        foreach ((array)$weather['WEATHER_DATA'] as &$item){
            AcmoApi::check($item);
            $popupWindow[] = [
                'name' => $item['METEO_NAME'],
                'lat' => $item['latitude'],
                'lon' => $item['longitude'],
                'temperature' => $item['T'],
                'render' => $this->renderPartial('_popup_window'),
            ];
        }
        /*$result = [];
        $transport = [];
        $forecast = [];
        foreach ($weather['WEATHER_DATA'] as $item){
            $imgList = $this->getData(1, 'videolist', [
                'id'=> $item['METEO_ID'],
                'date' => $date
            ]);
            $tm = $this->getData(1, 'tm', [
                'id'=> $item['METEO_ID'],
                'date' => str_replace(' ', '%20', date('d-m-Y H:i:s', time() - 7200 *5))
            ]);
            foreach ($tm['TM_DATA'] as $t){
                BaseAPI::check($t);
                $transport[] = [
                    'car' => $t['Car'],
                    'truck' => $t['STruck'] + $t['MTruck'] + $t['LTruck'] + $t['BTruck'] + 0,
                    'bus' => $t['Bus']
                ];
            }
            $forecast['now'] = $this->getData(1, 'forecast', ['id' => $item['METEO_ID'], 'date' => $date]);
            $forecast['now_4'] = $this->getData(1, 'forecast', [
                'id' => $item['METEO_ID'],
                'date' => str_replace(' ', '%20', date('d-m-Y H:i:s', time() + 3600 * 4))
            ]);
            $forecast['now_8'] = $this->getData(1, 'forecast', [
                'id' => $item['METEO_ID'],
                'date' => str_replace(' ', '%20', date('d-m-Y H:i:s', time() + 3600 * 8))
            ]);
            $forecast['now_12'] = $this->getData(1, 'forecast', [
                'id' => $item['METEO_ID'],
                'date' => str_replace(' ', '%20', date('d-m-Y H:i:s', time() + 3600 * 12))
            ]);

            foreach ($forecast as &$value){
                BaseAPI::check($value['WEATHER_DATA']);
            }

            $result = [
                'name' => $item['METEO_NAME'],
                'img' => $this->getModelApi(1)->getVideoByVideoList($imgList['VIDEO_DATA']),
                't' => $item['T'],
                'date' => date('d.m.Y H:i', strtotime($item['WEATHER_DATE'])),
                't_road' => $item['t_road'],
                'u' => $item['U'],
                'po' => $item['PO'],
                'road_state' => (!empty($item['road_state'])) ? AcmoApi::$road_state[$item['road_state']] : '',
                'adhesion' => $item['ADHESION'],
                'prec_type' => (!empty($item['PREC_TYPE'])) ? AcmoApi::$prec_type[$item['PREC_TYPE']] : '',
                'prec_sum' => $item['PREC_SUM'],
                'ff' => $item['FF'],
                'transport' => $transport,
                'forecast' => $forecast
            ];
            break;
        }*/

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
