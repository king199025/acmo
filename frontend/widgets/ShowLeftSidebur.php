<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 29.10.2017
 * Time: 17:26
 */

namespace frontend\widgets;

use kartik\base\Widget;

class ShowLeftSidebur extends Widget
{
    public function run()
    {
        return $this->render('left-sidebur');
    }
}