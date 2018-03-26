<?php

namespace frontend\modules\video\controllers;

use common\classes\Debug;
use common\models\AcmoApi;
use common\models\Region;
use yii\web\Controller;

/**
 * Default controller for the `video` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $pdk_id = \Yii::$app->session->get('pdk_id');
        $region = Region::findOne($pdk_id);
        $api = AcmoApi::get($region)->getCacheData();

        return $this->render('index', ['photos' => $api->photo, 'meteo' => $api->meteo]);
    }

    public function actionView($id, $date = null)
    {
        $pdk_id = \Yii::$app->session->get('pdk_id');
        $region = Region::findOne($pdk_id);
        $api = AcmoApi::get($region)->getCacheData();
        $api->getNextPrevIds($id);
        $photos = $api->photo[$id];
        $meteo = $api->meteo[$id];

        if ($date !== null) {
            $photos = AcmoApi::get($region)->getVideoByVideoList($id, date('d.m.Y 10:00', strtotime($date)));
        }

        if (\Yii::$app->request->isAjax) {
            return $this->renderPartial('elements/photo', ['meteo' => $meteo, 'photos' => $photos]);
        }

        return $this->render('view', [
            'photos' =>$photos,
            'meteo' => $meteo,
            'prev' => $api->prevId,
            'next' => $api->nextId
        ]);
    }
}
