<?php

namespace frontend\modules\video\controllers;

use common\classes\Debug;
use common\models\AcmoApi;
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
        $api = AcmoApi::get(1)->getCacheData();

        return $this->render('index', ['photos' => $api->photo, 'meteo' => $api->meteo]);
    }

    public function actionView($id, $date = null){

        $api = AcmoApi::get(1)->getCacheData();
        $api->getNextPrevIds($id);
        $photos = $api->photo[$id];
        $meteo = $api->meteo[$id];

        if ($date !== null) {
            $photos = AcmoApi::get(1)->getVideoByVideoList($id, date('d.m.Y 10:00', strtotime($date)));
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
