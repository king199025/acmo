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
                    <th class="mr-location" rowspan="2">Место</th>
                    <th class="mr-time" rowspan="2">Время наблюдения</th>
                    <th class="mr-photo-ico" rowspan="2"><img src="img/icons/table-photo-head.png" alt="photo"></th>
                    <th class="mr-weather-ico" rowspan="2"><img src="img/icons/table-weather-head.png" alt="weather">
                    </th>
                    <th class="mr-fallout" colspan="6">Погода</th>
                    <th class="mr-wind" colspan="3">Ветер</th>
                    <th class="mr-coating" colspan="4">Дорога</th>
                </tr>
                <tr>
                    <th class="mr-fallout-type">Тип осадков</th>

                    <!--<th class="mr-fallout-sum">Сумма,мм</th>-->
                    <th class="mr-fallout-intensity">Интен. осадков, мм/час</th>
                    <th class="mr-temp">Т возд., C</th>
                    <th class="mr-dew" >Точка росы, С</th>
                    <th class="mr-wet" >Влаж., %</th>
                    <th class="mr-pressure" >Давл., гПа</th>
                    <th class="mr-wind-grd">грд</th>
                    <th class="mr-wind-grd">Направление</th>
                    <th class="mr-wind-ms">м/с</th>
                    <th class="mr-coating-compos">Сост</th>
                    <th class="mr-coating-c">С</th>
                    <th>Сцепление</th>
                    <th>Слой осадков</th>
                </tr>

                </thead>
                <tbody>

                <?php foreach ($weather as $item): ?>
                    <tr>
                        <td class="mr-post-control">
                            <a href="<?php echo \yii\helpers\Url::to(['/weather/forecast', 'id' => $item['METEO_ID']])?>"><span><?php echo $item['METEO_NAME'] ?></span></a>
                        </td>
                        <td class="mr-time"><?php echo $item['WEATHER_UDATE'] ?></td>
                        <td class="mr-photo-ico">
                            <a href="<?php echo \yii\helpers\Url::to(['/video/view', 'id' => $item['METEO_ID']])?>" class="">
                                <img src="img/icons/table-photo.png" alt="">
                            </a>
                        </td>
                        <td class="mr-weather-ico">
                        <?php
                            if ($item['weather'] > 0){
                                echo '<img src="/img/icons/' . \common\models\AcmoApi::$weather[$item['weather']]['img'] . '" alt="">';
                            }else echo 'Нет';
                            ?>
                        </td>
                        <td class="mr-fallout-type">
                            <?php
                            if(isset($item['prec_type'])){
                                echo \common\models\AcmoApi::$prec_type[$item['prec_type']];
                            }
                            ?>
                        </td>
                        <!--<td class="mr-fallout-sum"><?php /*echo $item['prec_sum'] */?></td>-->
                        <td class="mr-fallout-intensity"><?php echo $item['prec_intensity'] ?></td>
                        <td class="mr-temp"><?php echo $item['T'] ?></td>
                        <td class="mr-dew"><?php echo $item['dewpoint'] ?></td>
                        <td class="mr-wet"><?php echo $item['U'] ?></td>
                        <td class="mr-pressure"><?php echo $item['PO'] ?></td>
                        <td class="mr-wind-grd"><?php echo $item['DD'] ?></td>
                        <td><img src="img/icons/wind-direction-dark.png" style="transform: rotate(<?= $item['DD']?>deg)" alt=""></td>
                        <td class="mr-wind-ms"><?php echo $item['FF'] ?></td>

                        <td class="mr-coating-compos">
                            <?php
                            if(isset($item['road_state'])){
                                echo \common\models\AcmoApi::$road_state[$item['road_state']];
                            }
                            ?>
                        </td>
                        <td class="mr-coating-c"><?php echo $item['t_road'] ?></td>
                        <td class="mr-coating-c"><?php echo $item['adhesion'] ?></td>
                        <td class="mr-fallout-sum"><?php echo $item['prec_sum'] ?></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    </section>
    <!-- end meteo-review.html-->
    </main>

</div>