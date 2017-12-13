<?php
/**
 * @var $this yii\web\View
 * @var array $weather
 * @var array $popupWindow
 */
?>
<div class="app">
    <!-- start meteo-review.html-->
    <section class="meteo meteo-review">
        <div class="content">
            <table>
                <thead>
                <tr>
                    <th rowspan="2" class="mr-pdk">ПДК</th>
                    <th class="mr-post-control">Пост контроля</th>
                    <th class="mr-time" rowspan="2">Время наблюдения</th>
                    <th class="mr-photo-ico" rowspan="2"><img src="img/icons/table-photo-head.png" alt="photo"></th>
                    <th class="mr-weather-ico" rowspan="2"><img src="img/icons/table-weather-head.png" alt="weather">
                    </th>
                    <th class="mr-fallout" colspan="3">Осадки</th>
                    <th class="mr-temp" rowspan="2">Т возд., C</th>
                    <th class="mr-dew" rowspan="2">Точка росы, С</th>
                    <th class="mr-wet" rowspan="2">Влаж., %</th>
                    <th class="mr-pressure" rowspan="2">Давл., гПа</th>
                    <th class="mr-wind" colspan="2">Ветер</th>
                    <th class="mr-coating" colspan="2">Покрытие</th>
                    <th class="mr-ice" rowspan="2">% льда</th>
                </tr>
                <tr>
                    <th class="mr-location">Местоположение (км+)</th>
                    <th class="mr-fallout-type">Тип</th>
                    <th class="mr-fallout-sum">Сумма,мм</th>
                    <th class="mr-fallout-intensity">Интен., мм/час</th>
                    <th class="mr-wind-grd">грд</th>
                    <th class="mr-wind-ms">м/с</th>
                    <th class="mr-coating-compos">Сост</th>
                    <th class="mr-coating-c">С</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($weather as $item): ?>
                        <?php $item['METEO_NAME'] = \common\models\AcmoApi::parsePdkName($item['METEO_NAME'])?>
                    <tr>
                        <td class="mr-pdk"><?php echo $item['METEO_NAME']['id'] ?></td>
                        <td class="mr-post-control">
                            <a href="<?php echo \yii\helpers\Url::to(['/weather/forecast', 'id' => $item['METEO_ID']])?>"><span class="city"><?php echo $item['METEO_NAME']['name'] ?></span></a>
                            <span class="direction"><?php echo $item['METEO_NAME']['distance'] ?></span>
                        </td>
                        <td class="mr-time"><?php echo $item['WEATHER_UDATE'] ?></td>
                        <td class="mr-photo-ico">
                            <a href="<?php echo \yii\helpers\Url::to(['/video/view', 'id' => $item['METEO_ID']])?>" class="">
                                <img src="img/icons/table-photo.png" alt="">
                            </a>
                        </td>
                        <td class="mr-weather-ico"><img src="
                        <?php
                            echo 'img/icons/' . \common\models\AcmoApi::$weather[$item['weather']]['img'];
                            ?>" alt="">
                        </td>
                        <td class="mr-fallout-type">
                            <?php
                            if(isset($item['prec_type'])){
                                echo \common\models\AcmoApi::$prec_type[$item['prec_type']];
                            }
                            ?>
                        </td>
                        <td class="mr-fallout-sum"><?php echo $item['prec_sum'] ?></td>
                        <td class="mr-fallout-intensity"><?php echo $item['prec_intensity'] ?></td>
                        <td class="mr-temp"><?php echo $item['T'] ?></td>
                        <td class="mr-dew"><?php echo $item['dewpoint'] ?></td>
                        <td class="mr-wet"><?php echo $item['U'] ?></td>
                        <td class="mr-pressure"><?php echo $item['PO'] ?></td>
                        <td class="mr-wind-grd"><?php echo $item['DD'] ?></td>
                        <td class="mr-wind-ms"><?php echo $item['FF'] ?></td>
                        <td class="mr-coating-compos">
                            <?php
                            if(isset($item['road_state'])){
                                echo \common\models\AcmoApi::$road_state[$item['road_state']];
                            }
                            ?>
                        </td>
                        <td class="mr-coating-c"><?php echo $item['t_road'] ?></td>
                        <td class="mr-ice"><?php echo $item['adhesion'] ?></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    </section>
    <!-- end meteo-review.html-->
    </main>

</div>