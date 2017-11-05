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
        $api = AcmoApi::get(1);
        $api->getAllTraffic();

        foreach ($api->names as $id => $name) {
            $names[$id] = AcmoApi::parsePdkName($name);
        }

        return $this->render('index', ['traffics' => $api->traffic, 'names' => $names]);
    }

    public function actionView($id)
    {
        $api = AcmoApi::get(1);
        $api->getTrafficById($id, date(AcmoApi::DATE_FORMAT, time()));
        $api->getAllVideo();
        $api->getNextPrevIds($id, array_keys($api->traffic));

        return $this->render('view', [
            'traffic' => $api->traffic,
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
        //Debug::prn($api->traffic);
        return $this->render('archive', ['traffics' => $api->traffic]);
    }
}
