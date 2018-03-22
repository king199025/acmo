<?php

namespace frontend\modules\traffic\controllers;

use common\classes\Debug;
use common\models\AcmoApi;
use yii\web\Controller;
use common\models\Region;

/**
 * Default controller for the `traffic` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $names = [];
        $pdk_id = \Yii::$app->session->get('pdk_id');
        $region = Region::findOne($pdk_id);
        $api = AcmoApi::get($region)->getCacheData();

        foreach ($api->names as $id => $name) {
            $names[$id] =$name;
        }

        return $this->render('index', ['traffics' => $api->traffic, 'names' => $names]);
    }

    public function actionView($id)
    {
        $pdk_id = \Yii::$app->session->get('pdk_id');
        $region = Region::findOne($pdk_id);
        $api = AcmoApi::get($region)->getCacheData();
        $api->getNextPrevIds($id);
        $api->traffic[$id][0]['analise'] = $this->getTrafficAnalise($api->traffic[$id][0]);
        $api->traffic[$id][1]['analise'] = $this->getTrafficAnalise($api->traffic[$id][1]);

        return $this->render('view', [
            'traffic' => $api->traffic[$id],
            'photo' => $api->photo[$id],
            'next' => $api->nextId,
            'prev' => $api->prevId,
            'name' => $api->names[$id]
        ]);
    }

    public function actionArchive($id)
    {
        $pdk_id = \Yii::$app->session->get('pdk_id');
        $region = Region::findOne($pdk_id);
        $api = AcmoApi::get($region);
        $api->getTrafficArchive($id, date(AcmoApi::DATE_FORMAT, time()));

        return $this->render('archive', ['traffics' => $api->traffic]);
    }

    private function getTrafficAnalise($traffic)
    {
        $greenStatistic = $traffic['IncJam'] == 0 && $traffic['Occ'] < 50 && $traffic['S'] > 70;
        $yellowStatistic = $traffic['IncJam'] == 0 && $traffic['Occ'] > 50 && $traffic['Occ'] < 80
            && $traffic['S'] > 40 && $traffic['S'] < 70;
        $redStatistic = $traffic['Dist'] <= 5 && $traffic['Occ'] > 80
            && $traffic['S'] <= 40 && $traffic['AllT'] > 5;

        if ($greenStatistic){
            return 'green';
        }
        if ($yellowStatistic){
            return 'yellow';
        }
        if ($redStatistic){
            return 'red';
        }return 'grey';
    }
}
