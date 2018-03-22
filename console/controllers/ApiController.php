<?php
/**
 * Created by PhpStorm.
 * User: Антон
 * Date: 04.11.2017
 * Time: 18:06
 */

namespace console\controllers;

use common\models\Region;
use console\models\ConsoleApi;
use \yii\console\Controller;
use yii\helpers\Console;

class ApiController extends Controller
{
    public function actionIndex()
    {
        echo 'Hello';
    }

    public function actionCachePhoto()
    {
        /*$api = ConsoleApi::get(1);

        if($api->getAllVideo()){
            $this->stdout("Caching photo successful\n", Console::FG_GREEN);
        }else $this->stdout("An error occurred during caching!!!\n", Console::FG_RED);*/
    }

    public function actionCacheData()
    {
        $regions = Region::find()->all();

        foreach ($regions as $region) {
            $api = ConsoleApi::get($region)->setCacheData();

            if($api) {
                $this->stdout("Caching data successful\n", Console::FG_GREEN);
            }
        }
    }
}