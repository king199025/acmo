<?php
/**
 * @var $this \yii\web\View
 * @var $statistic array
 */

use yii\helpers\ArrayHelper;
?>

<!-- start traffic-chart.html-->
<section class="traffic-chart">
    <!-- start header-section.html-->
    <div class="s-header">
        <div class="s-header__side">
            <button class="btn btn-left"></button>
            <button class="btn btn-right"></button>
            <span><?php echo $name?></span>
        </div>
        <div class="s-header__side">
            <!--<button class="btn">Архив</button>
            <button class="btn">Текущие</button>
            <button class="btn">Прогноз</button>-->
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
                        return date('H:i', strtotime($item['date']));
                    }, $statistic)
                ],
                'yAxis' => [
                    'title' => ['text' => 'Температура измерения'],
                    'maxPadding' => 0.01,
                    'min' => -5,
                    'endOnTick' => false,
                    'minPadding' => 0,01
                ],
                'series' => [
                    ['name' => 'Легковые', 'data' => array_map('intval', ArrayHelper::getColumn($statistic, 'Car'))],
                    ['name' => 'Автобусы', 'data' => array_map('intval', ArrayHelper::getColumn($statistic, 'Bus'))],
                    ['name' => 'Грузовые до 5т', 'data' => array_map('intval', ArrayHelper::getColumn($statistic, 'STruck'))],
                    ['name' => 'Грузовые от 5 до 12т', 'data' => array_map('intval', ArrayHelper::getColumn($statistic, 'MTruck'))],
                    ['name' => 'Грузовые от 12 до 20т', 'data' => array_map('intval', ArrayHelper::getColumn($statistic, 'LTruck'))],
                    ['name' => 'Грузовые более 20т', 'data' => array_map('intval', ArrayHelper::getColumn($statistic, 'BTruck'))],
                ],
            ]
        ]); ?>

        </div>
</section>
<!-- end traffic-chart.html-->

