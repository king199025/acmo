<?php
/**
 * Created by PhpStorm.
 * User: Антон
 * Date: 05.11.2017
 * Time: 19:14
 */

namespace frontend\widgets;


use common\classes\Debug;
use kartik\base\Widget;

class SliderWidget extends Widget
{
    public $photo;
    public $date;

    public function run()
    {
        return $this->render('slider', ['photo' => $this->photo, 'date' => $this->date]);
    }
}