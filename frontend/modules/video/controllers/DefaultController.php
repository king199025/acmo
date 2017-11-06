<?php

namespace frontend\modules\video\controllers;

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

    public function actionView($id){
        $api = AcmoApi::get(1)->getCacheData();
        $api->getNextPrevIds($id);

        return $this->render('view', [
            'photos' => $api->photo[$id],
            'meteo' => $api->meteo[$id],
            'prev' => $api->prevId,
            'next' => $api->nextId
        ]);
    }
}
