<!-- start meteo-review-traffic.html-->
<section class="meteo meteo-review-traffic">
    <div class="content">
        <table>
            <thead>
            <tr>
                <th rowspan="2" class="mrt-pdk">ПДК</th>
                <th class="mrt-post-name">Наименование ПДК</th>
                <th class="mrt-chart" rowspan="1" colspan="2">Схема</th>
                <th class="mrt-photo-ico" rowspan="2"><img src="img/icons/table-photo-head.png" alt="photo"></th>
                <th class="mrt-time" rowspan="2">Время наблюдения</th>
                <th class="mrt-speed" rowspan="1" colspan="2">Скорость потока, км/ч</th>
                <th class="mrt-distance" rowspan="1" colspan="2">Дистанция, м</th>
                <th class="mrt-fullness" rowspan="1" colspan="2">Загруженность, %</th>
                <th class="mrt-amount" rowspan="1" colspan="2">Обьем движения, авт/ч</th>
                <th class="mrt-state" rowspan="1" colspan="2">Состояние потока</th>
                <th class="mrt-ellipsis" rowspan="2">...</th>
            </tr>
            <tr>
                <th class="mr-location">Местоположение (км+)</th>
                <th class="mr-fallout-sum"><img class="arrow" src="/img/icons/arrow-reverse.png" alt="arrow-down"></th>
                <th class="mr-fallout-type"><img class="arrow" src="/img/icons/arrow-direct.png" alt="arrow-top"></th>
                <th class="reverse"><img class="arrow" src="/img/icons/arrow-reverse.png" alt="">обратное</th>
                <th class="direct"><img class="arrow" src="/img/icons/arrow-direct.png" alt="">прямое</th>
                <th class="reverse"><img class="arrow" src="/img/icons/arrow-reverse.png" alt="">обратное</th>
                <th class="direct"><img class="arrow" src="/img/icons/arrow-direct.png" alt="">прямое</th>
                <th class="reverse"><img class="arrow" src="/img/icons/arrow-reverse.png" alt="">обратное</th>
                <th class="direct"><img class="arrow" src="/img/icons/arrow-direct.png" alt="">прямое</th>
                <th class="reverse"><img class="arrow" src="/img/icons/arrow-reverse.png" alt="">обратное</th>
                <th class="direct"><img class="arrow" src="/img/icons/arrow-direct.png" alt="">прямое</th>
                <th class="reverse"><img class="arrow" src="/img/icons/arrow-reverse.png" alt="">обратное</th>
                <th class="direct"><img class="arrow" src="/img/icons/arrow-direct.png" alt="">прямое</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($traffics as $pdk_id => $traffic):?>
                <?php if(is_array($traffic[0])):?>
                    <tr>
                        <td class="mrt-pdk"><img class="block-img" src="/img/icons/block-green.png" alt=""><?php echo $names[$pdk_id]['id']?></td>
                        <td class="mrt-name-location">
                            <a href="<?php echo \yii\helpers\Url::to(['/traffic/view', 'id' => $pdk_id])?>"><span class="city"><?php echo $names[$pdk_id]['name']?></span></a>
                            <span class="direction"><?php echo $names[$pdk_id]['distance']?></span>
                        </td>
                        <td class="mrt-chart-reverse"><img class="arrow" src="img/icons/arrow-reverse-green.png" alt=""></td>
                        <td class="mrt-chart-direct"><img class="arrow" src="img/icons/arrow-direct-green.png" alt=""></td>
                        <td class="mrt-photo-ico"><a href="<?php echo \yii\helpers\Url::to(['/video/view', 'id' => $pdk_id])?>"><img src="img/icons/table-photo-green.png" alt=""></a></td>
                        <td class="mrt-time"><?php echo $traffic[0]['TM_DATE']?></td>
                        <td class="mrt-speed-reverse"><?php echo $traffic[1]['S']?></td>
                        <td class="mrt-speed-direct direct"><?php echo $traffic[0]['S']?></td>
                        <td class="mrt-distance-reverse"><?php echo $traffic[1]['Dist']?></td>
                        <td class="mrt-distance-direct direct"><?php echo $traffic[0]['Dist']?></td>
                        <td class="mrt-fullness-reverse"><?php echo $traffic[1]['Occ']?></td>
                        <td class="mrt-fullness-direct direct"><?php echo $traffic[0]['Occ']?></td>
                        <td class="mrt-amount-reverse"></td>
                        <td class="mrt-amount-direct direct"></td>
                        <td class="mrt-state-reverse"></td>
                        <td class="mrt-state-direct direct"></td>
                        <td class="mrt-ellipsis"></td>
                    </tr>
                <?php endif;?>
            <?php endforeach;?>

            </tbody>
        </table>
    </div>

</section>
<!-- end meteo-review-traffic.html-->