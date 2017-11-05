<?php
/**
 * Created by PhpStorm.
 * User: Антон
 * Date: 04.11.2017
 * Time: 18:06
 */

namespace console\controllers;

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
        $api = ConsoleApi::get(1);
        $api->getAllVideo();
        if(!empty($api->photo)){
            $this->stdout("Caching photo successful\n", Console::FG_GREEN);
        }else $this->stdout("An error occurred during caching!!!\n", Console::FG_RED);
    }
}