<?php
/**
 * @var $this \yii\web\View
 * @var array $weather
 */
?>
<?php if (count($weather) > 1):?>
<?php foreach ($weather as $item): ?>

    <?php \common\models\AcmoApi::check($item) ?>
    <tr>
        <td class="ma-when"><?php echo $item['WEATHER_DATE'] ?></td>
        <td class="ma-weather-ico"><img src="/img/icons/<?php echo \common\models\AcmoApi::$weather[$item['weather']]['img'] ?>"
                                        alt="">
        </td>
        <td class="ma-fallout-type"><?php echo \common\models\AcmoApi::$prec_type[$item['prec_type']] ?></td>
        <td class="ma-fallout-sum"><?php echo $item['prec_sum'] ?></td>
        <td class="ma-fallout-intensity"><?php echo $item['prec_intensity'] ?></td>
        <td class="ma-temp"><?php echo $item['T'] ?></td>
        <td class="ma-dew"><?php echo $item['dewpoint'] ?></td>
        <td class="ma-wet"><?php echo $item['U'] ?></td>
        <td class="ma-pressure"><?php echo $item['PO'] ?></td>
        <td class="ma-wind-ms"><?php echo $item['FF'] ?></td>
        <td class="ma-wind-grd"><?php echo $item['DD'] ?></td>
        <td class="ma-coating-temp"><?php echo $item['t_road'] ?></td>
        <td class="ma-coating-compos"><?php echo \common\models\AcmoApi::$road_state[$item['road_state']] ?></td>
        <td class="ma-coating-clutch"></td>
        <td class="ma-road-body-temp-min"></td>
        <td class="ma-road-body-temp-max"></td>
        <td class="ma-layer-fallout-water"></td>
        <td class="ma-layer-fallout-snow"></td>
        <td class="ma-layer-fallout-ice"></td>
    </tr>

<?php endforeach; ?>

<?php endif;?>
