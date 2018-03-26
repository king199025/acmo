<?php
/**
 * Created by PhpStorm.
 * User: Тоха
 * Date: 22.03.2018
 * Time: 12:36
 */

namespace frontend\controllers;


use frontend\models\user\UserDec;
use yii\web\Controller;

class UsersController extends Controller
{
    public function actionSetting($user_id)
    {
        $user =  UserDec::findOne($user_id);

        return $this->render('setting', ['user' => $user]);
    }
}