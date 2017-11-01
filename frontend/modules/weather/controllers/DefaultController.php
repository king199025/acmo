<?php

namespace frontend\modules\weather\controllers;

use common\models\AcmoApi;
use common\models\Region;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `weather` module
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
     */
    public function actionIndex()
    {
        $region = Region::findOne(1);
        $weather = AcmoApi::get($region->url)
            ->getData('meteo', ['date' => date('d-m-Y', time())]);

        return $this->render('index', ['weather' => $weather]);
    }

    public function actionView($id)
    {
        $region = Region::findOne(1);
        $weather = AcmoApi::get($region->url)
            ->getData('forecasta', ['date' => date('d-m-Y', time()), 'id' => $id]);

        return $this->render('view', ['weather' => $weather]);
    }
}
