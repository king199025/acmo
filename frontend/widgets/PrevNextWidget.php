<?php
/**
 * Created by PhpStorm.
 * User: Тоха
 * Date: 13.12.2017
 * Time: 12:05
 */

namespace frontend\widgets;


use yii\base\Widget;

class PrevNextWidget extends Widget
{
    public $next;
    public $prev;
    public $url;
    public $name;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    public function run()
    {
        return $this->render('prev_next', [
            'next' => $this->next,
            'prev' => $this->prev,
            'url' => $this->url,
            'name' => $this->name,
        ]);
    }
}