<?php

namespace frontend\modules\traffic\controllers;

use common\classes\Debug;
use common\models\AcmoApi;
use yii\web\Controller;

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
        $api = AcmoApi::get(1)->getCacheData();

        foreach ($api->names as $id => $name) {
            $names[$id] = AcmoApi::parsePdkName($name);
        }

        return $this->render('index', ['traffics' => $api->traffic, 'names' => $names]);
    }

    public function actionView($id)
    {
        $api = AcmoApi::get(1)->getCacheData();
        $api->getNextPrevIds($id);

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
        $api = AcmoApi::get(1);
        $api->getTrafficArchive($id, date(AcmoApi::DATE_FORMAT, time()));

        return $this->render('archive', ['traffics' => $api->traffic]);
    }
}
