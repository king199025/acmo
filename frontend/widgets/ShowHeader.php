<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 29.10.2017
 * Time: 16:44
 */

namespace frontend\widgets;

use yii\base\Widget;

class ShowHeader extends Widget
{
    public function run()
    {
        return $this->render('header');
    }
}