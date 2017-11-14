<?php
/**
 * @var $this \yii\web\View
 * @var $forecast array
 */

use yii\helpers\ArrayHelper;
?>

<section class="meteo-chart">
    <!-- start header-section.html-->
    <div class="s-header">
        <div class="s-header__side">
            <button class="btn btn-left"></button>
            <button class="btn btn-right"></button>
            <span><?php echo $name?></span>
        </div>
        <div class="s-header__side">
            <button class="btn">Архив</button>
            <button class="btn">Текущие</button>
            <button class="btn">Прогноз</button>
        </div>
    </div>
    <!-- end header-section.html-->
    <div class="content">
        <?php echo \miloschuman\highcharts\Highcharts::widget([
            'options' => [
                'title' => ['text' => 'График температуры, C'],
                'xAxis' => [
                    'title' => ['text' => 'Время измерения'],
                    //'type' => 'Logarithmic',
                    'categories' => array_map(function ($item) {
                        return date('m-d H:i', strtotime($item));
                    }, $x)
                ],
                'yAxis' => [
                    'title' => ['text' => 'Температура измерения'],
                    /*'maxPadding' => 0.01,
                    'min' => -5,
                    'endOnTick' => false,
                    'minPadding' => 0,01*/
                ],
                'series' => [
                    //['name' => 'Температура воздуха(макс)', 'data' => array_map('floatval', ArrayHelper::getColumn($forecast, 'T')), 'color' => '#00008B'],
                    //['name' => 'Температура воздуха(мин)', 'data' => [0 => 20, 1 => 7, 2 => 3]],
                    ['name' => 'Температура воздуха (сред)', 'data' => array_map('floatval', ArrayHelper::getColumn($forecast, 'T')), 'type' => 'line', 'color' => 'red', 'yAxis' => 0],
                    ['name' => 'Температура точки росы', 'data' => array_map('floatval', ArrayHelper::getColumn($forecast, 'dewpoint')), 'color' => 'yellow'],
                    //['name' => 'Температура покрытия', 'data' => array_map('intval', ArrayHelper::getColumn($forecast, 't_road')), 'color' => 'red'],
                ],
            ]
        ]); ?>

    </div>
</section>
<!-- end meteo-chart.html-->
