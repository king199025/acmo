<?php
/**
 * @var $this \yii\web\View
 * @var $forecast array
 */
?>
<section class="traffic-data">
    <!-- start header-section.html-->
    <div class="s-header">
        <?php echo \frontend\widgets\PrevNextWidget::widget([
                'next' => $next,
                'prev' => $prev,
                'url' => '/weather/forecast',
                'name' => $forecast['METEO_NAME']
            ])?>
        <div class="s-header__side">
            <a href="<?php echo \yii\helpers\Url::to(['/chart/meteo', 'id' => $forecast['METEO_ID']])?>" class="btn margin-right-10"><img src="/img/icons/calculator.png" alt=""></a>
            <a href="<?php echo \yii\helpers\Url::to(['/weather/forecast/view', 'id' => $forecast['METEO_ID'], 'date' => date('d-m-Y 00:00', time() - 86400)])?>" class="btn">Архив</a>
            <a href="<?php echo \yii\helpers\Url::to(['/weather/forecast', 'id' => $forecast['METEO_ID']])?>"class="btn">Текущие</a>
            <a href="<?php echo \yii\helpers\Url::to(['/weather/forecast/view', 'id' => $forecast['METEO_ID'], 'date' => date('d-m-Y 00:00', time() + 86400)])?>"class="btn">Прогноз</a>
        </div>
    </div>
    <!-- end header-section.html-->
    <div class="content">
        <div class="traffic-data__video">
            <?php echo \frontend\widgets\SliderWidget::widget([
                    'photo' => $photo,
                    'date' => $forecast['WEATHER_DATE']
            ])?>
        </div>
        <div class="traffic-data__block">
            <div class="traffic-data__table--air">
                <table class="traffic-data__table">
                    <thead>
                    <tr>
                        <th><span class="big-t">t<sup>0</sup></span> воздуха</th>
                        <th><img src="img/icons/snow-icon.png" alt="" width="35px" height="35px"></th>
                        <th><?php echo $forecast['T']?><sup>o</sup>C</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Влажность</td>
                        <td></td>
                        <td><?php echo $forecast['U']?>%</td>
                    </tr>
                    <tr>
                        <td>Давление</td>
                        <td></td>
                        <td><?php echo $forecast['PO']?></td>
                    </tr>
                    <tr>
                        <td>Тип осадков</td>
                        <td></td>
                        <td><?php echo \frontend\modules\weather\models\Forecast::$prec_type[$forecast['prec_type']]?></td>
                    </tr>
                    <tr>
                        <td>Скорость ветра</td>
                        <td><img src="img/icons/arrow-up-right.png" alt="" width="29px" height="22px"></td>
                        <td><?php echo $forecast['FF']?> м/с</td>
                    </tr>
                    </tbody>
                </table>
                <img class="road-string" src="/img/road-string2.png" alt="" width="115px" height="128px">
            </div>
            <div class="traffic-data__table--surface">
                <table class="traffic-data__table">
                    <thead>
                    <tr>
                        <th><span class="big-t">t<sup>0</sup></span> поверхности</th>
                        <th><?php echo $forecast['t_road']?><sup>o</sup>C</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Состояние</td>
                        <td><?php echo \frontend\modules\weather\models\Forecast::$road_state[$forecast['road_state']]?></td>
                    </tr>
                    <tr>
                        <td>Интенсивность осадков</td>
                        <td><?php echo $forecast['prec_intensity']?></td>
                    </tr>
                    <tr>
                        <td>Облачность</td>
                        <td><?php echo $forecast['clouds']?>%</td>
                    </tr>
                    <tr>
                        <td>Туман</td>
                        <td><?php echo ($forecast['fog'] > 0) ? $forecast['fog'] : 0 ?>%</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>