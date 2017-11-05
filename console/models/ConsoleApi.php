<?php
/**
 * Created by PhpStorm.
 * User: Антон
 * Date: 04.11.2017
 * Time: 18:07
 */

namespace console\models;


use common\models\AcmoApi;

class ConsoleApi extends AcmoApi
{
    public function __construct($url)
    {
        parent::__construct($url);
    }
}