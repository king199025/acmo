<?php
/**
 * @var $meteo array
 * @var $photo array
 * @var $forecast array
 * @var $traffic array
 */
?>

<!-- start map-modal.html-->
<div class="map__modal">
    <div class="map__modal--header">
        <span><?php echo $meteo['METEO_NAME']?></span>
    </div>
    <div class="map__modal--blocks">
        <div class="map__modal--block">
            <div class="map__modal--video">
                <?php echo \frontend\widgets\SliderWidget::widget(['photo' => $photo, 'date' => $meteo['WEATHER_DATE']])?>
                <div class="cars-type">
                    <div>
                        <p>Легковые</p>
                        <span><?php echo $traffic[0]['Car'] + 0?></span>
                        <span><?php echo $traffic[1]['Car'] + 0?></span>
                    </div>
                    <div>
                        <p>Грузовые</p>
                        <span><?php echo \common\models\AcmoApi::getTrucksCount($traffic[0])?></span>
                        <span><?php echo \common\models\AcmoApi::getTrucksCount($traffic[1])?></span>
                    </div>
                    <div>
                        <p>Автобусы</p>
                        <span><?php echo $traffic[0]['Bus'] + 0?></span>
                        <span><?php echo $traffic[1]['Bus'] + 0?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="map__modal--block">
            <div class="map__modal--center-top">
                <img class="map-star" src="img/icons/star.png" alt="">
                <table>
                    <thead>
                    <tr>
                        <th>Т воздух</th>
                        <th>
                            <?php if($meteo['weather']):?>
                                <img src="img/icons/<?php echo \common\models\AcmoApi::$weather[$meteo['weather']]['img']?>" alt="">
                            <?php endif;?>
                        </th>
                        <th><span><?php echo $meteo['T']?></span> °C</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Влажность</td>
                        <td></td>
                        <td><?php echo $meteo['U']?>%</td>
                    </tr>
                    <tr>
                        <td>Давление</td>
                        <td></td>
                        <td><?php echo $meteo['PO']?></td>
                    </tr>
                    <tr>
                        <td>Осадки</td>
                        <td><?php echo \common\models\AcmoApi::$prec_type[$meteo['prec_type']]?></td>
                        <td><?php echo $meteo['prec_sum']?> мм</td>
                    </tr>
                    <tr>
                        <td>Ветер</td>
                        <td><img src="img/icons/wind-direction-dark.png" style="transform: rotate(<?php echo $meteo['DD']?>deg)" alt=""></td>
                        <td><?php echo $meteo['FF']?> м/с</td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="map__modal--center-bottom">
                <table>
                    <tbody>
                    <tr>
                        <td>Т поверх.:</td>
                        <td class="color-blue"><?php echo $meteo['t_road']?> °C</td>
                    </tr>
                    <tr>
                        <td>Состояние</td>
                        <td class="color-white"><?php echo \common\models\AcmoApi::$road_state[$meteo['road_state']]?></td>
                    </tr>
                    <tr>
                        <td>Сцепление</td>
                        <td class="color-green"><?php echo $meteo['adhesion']?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--<div class="map__modal--block">-->
        <!--    <div class="map__modal--forecast">-->
        <!--        <table>-->
        <!--            <thead>-->
        <!--            <tr>-->
        <!--                <th></th>-->
        <!--                <th>Погода</th>-->
        <!--                <th>Ветер</th>-->
        <!--                <th>Воздух</th>-->
        <!--                <th>Дорога</th>-->
        <!--            </tr>-->
        <!--            </thead>-->
        <!--            <tbody>-->
        <!---->
        <!--            <tr>-->
        <!--                <td class="bg-green">Сейчас</td>-->
        <!--                <td>-->
        <!--                    --><?php //if ($forecast[0]['weather']):?>
        <!--                        <img src="img/icons/--><?php //echo \common\models\AcmoApi::$weather[$forecast[0]['weather']]['img']?><!--" alt="">-->
        <!--                    --><?php //endif;?>
        <!--                </td>-->
        <!--                <td>--><?php //echo $forecast[0]['FF']?><!--</td>-->
        <!--                <td>--><?php //echo $forecast[0]['T']?><!--</td>-->
        <!--                <td>--><?php //echo $forecast[0]['t_road']?><!--</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td class="bg-yellow">--><?php //echo date('H:i', strtotime($forecast[1]['WEATHER_DATE']))?><!--</td>-->
        <!--                <td>-->
        <!--                    --><?php //if ($forecast[1]['weather']):?>
        <!--                        <img src="img/icons/--><?php //echo \common\models\AcmoApi::$weather[$forecast[1]['weather']]['img']?><!--" alt="">-->
        <!--                    --><?php //endif;?>
        <!--                </td>-->
        <!--                <td>--><?php //echo $forecast[1]['FF']?><!--</td>-->
        <!--                <td>--><?php //echo $forecast[1]['T']?><!--</td>-->
        <!--                <td>--><?php //echo $forecast[1]['t_road']?><!--</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td class="bg-grey">--><?php //echo date('H:i', strtotime($forecast[2]['WEATHER_DATE']))?><!--</td>-->
        <!--                <td>-->
        <!--                    --><?php //if ($forecast[2]['weather']):?>
        <!--                        <img src="img/icons/--><?php //echo \common\models\AcmoApi::$weather[$forecast[2]['weather']]['img']?><!--" alt="">-->
        <!--                    --><?php //endif;?>
        <!--                </td>-->
        <!--                <td>--><?php //echo $forecast[2]['FF']?><!--</td>-->
        <!--                <td>--><?php //echo $forecast[2]['T']?><!--</td>-->
        <!--                <td>--><?php //echo $forecast[2]['t_road']?><!--</td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td class="bg-grey">--><?php //echo date('H:i', strtotime($forecast[3]['WEATHER_DATE']))?><!--</td>-->
        <!--                <td>-->
        <!--                    --><?php //if ($forecast[3]['weather']):?>
        <!--                        <img src="img/icons/--><?php //echo \common\models\AcmoApi::$weather[$forecast[3]['weather']]['img']?><!--" alt="">-->
        <!--                    --><?php //endif;?>
        <!--                </td>-->
        <!--                <td>--><?php //echo $forecast[3]['FF']?><!--</td>-->
        <!--                <td>--><?php //echo $forecast[3]['T']?><!--</td>-->
        <!--                <td>--><?php //echo $forecast[3]['t_road']?><!--</td>-->
        <!--            </tr>-->
        <!--            </tbody>-->
        <!--        </table>-->
        <!--        <ul class="map__modal--review">-->
        <!--            <li><span class="bg-red"></span>Остановки в движении</li>-->
        <!--            <li><span class="bg-yellow"></span>Медленное движение</li>-->
        <!--            <li><span class="bg-green"></span>Бесперебойное движение</li>-->
        <!--            <li><span class="bg-grey"></span>Нет данных</li>-->
        <!--        </ul>-->
        <!--    </div>-->
        <!--</div>-->
    </div>
</div>
<!-- end map-modal.html-->