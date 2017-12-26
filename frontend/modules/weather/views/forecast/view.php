<?php
/**
 * @var $this \yii\web\View
 * @var $render string
 * @var $name string
 * @var $id integer
 */
?>

<!-- start meteo-archive-pdk.html-->
<section class="meteo meteo-archive">
    <!-- start header-section.html-->
    <div class="s-header">
        <?php echo \frontend\widgets\PrevNextWidget::widget([
            'url' => '/weather/forecast',
            'name' => $name,
            'prev' => $prev,
            'next' => $next
        ]) ?>
        <div class="s-header__side">
            <a href="<?php echo \yii\helpers\Url::to(['/chart/meteo', 'id' => $id])?>" class="btn margin-right-10"><img src="/img/icons/pie_chart.png" alt=""></a>
            <a href="<?php echo \yii\helpers\Url::to(['/weather/forecast/view', 'id' => $id, 'date' => date('d-m-Y 00:00', time() - 86400)])?>" class="btn">Архив</a>
            <a href="<?php echo \yii\helpers\Url::to(['/weather/forecast', 'id' => $id])?>"class="btn">Текущие</a>
            <a href="<?php echo \yii\helpers\Url::to(['/weather/forecast/view', 'id' => $id, 'date' => date('d-m-Y 00:00', time() + 86400)])?>"class="btn">Прогноз</a>
        </div>
    </div>
    <!-- end header-section.html-->
    <div class="content">
        <div class="filter">
            <span>Период с: </span><input class="date-from" type="date"><span>по: </span><input class="date-to" type="date">
        </div>
        <input type="hidden" id="meteo_id" value="<?php echo $id?>">
        <table>
            <thead>
            <tr>
                <th rowspan="2" class="ma-when">Время измерения</th>
                <th rowspan="2" class="ma-weather-ico"><img src="/img/icons/table-weather-head.png" alt="weather"></th>
                <th colspan="3" class="ma-fallout">Осадки</th>
                <th rowspan="2" class="ma-temp">Т возд., C</th>
                <th rowspan="2" class="ma-dew">Точка росы, С</th>
                <th rowspan="2" class="ma-wet">Влаж., %</th>
                <th rowspan="2" class="ma-pressure">Давл., гПа</th>
                <th colspan="2" class="ma-wind">Ветер</th>
                <th colspan="3" class="ma-coating">Поверхность</th>
                <th colspan="2" class="ma-road-body">Тело дороги</th>
                <th colspan="3" class="ma-layer-fallout">Слой осадков</th>
            </tr>
            <tr>
                <th class="ma-fallout-type">Тип</th>
                <th class="ma-fallout-sum">Сумма,мм</th>
                <th class="ma-fallout-intensity">Интен., мм/час</th>
                <th class="ma-wind-ms">Скор., м/с</th>
                <th class="ma-wind-grd">Напр., грд</th>
                <th class="ma-coating-temp">Темп., С</th>
                <th class="ma-coating-compos">Сост</th>
                <th class="ma-coating-clutch">К.сцепл.</th>
                <th class="ma-road-body-temp-min">Т.тела,С(6см)</th>
                <th class="ma-road-body-temp-max">Т.тела,С(30см)</th>
                <th class="ma-layer-fallout-water">Вода</th>
                <th class="ma-layer-fallout-snow">Снег</th>
                <th class="ma-layer-fallout-ice">Град</th>
            </tr>
            </thead>
            <tbody>
            <?php echo $render?>

            </tbody>
        </table>
    </div>

</section>
<!-- end meteo-archive-pdk.html-->
