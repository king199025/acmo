<?php
/**
 * @var $this \yii\web\View
 * @var $traffics array
 */
?>


<!-- start traffic-table.html-->
<section class="traffic-table">
    <!-- start header-section.html-->
    <div class="s-header">
        <div class="s-header__side">
            <button class="btn btn-left"></button>
            <button class="btn btn-right"></button>
            <span><?php echo $traffics[0][0]['TM_NAME']?></span>
        </div>
        <div class="s-header__side">
            <a href="<?php echo \yii\helpers\Url::to(['/traffic/archive', 'id' => $traffics[0][0]['TM_ID']])?>" class="btn">Архив</a>
            <a href="<?php echo \yii\helpers\Url::to(['/traffic/view', 'id' => $traffics[0][0]['TM_ID']])?>" class="btn">Текущие</a>
        </div>
    </div>
    <!-- end header-section.html-->
    <div class="content">
        <table>
            <thead>
            <tr>
                <th rowspan="2" class="tt-day">День</th>
                <th rowspan="2" class="tt-clock"><img src="/img/icons/clock.png" alt="clock"></th>
                <th rowspan="2" class="tt-car">Легковые</th>
                <th rowspan="2" class="tt-bus">Автобусы</th>
                <th colspan="4" class="tt-truck-type">Грузовые по типам</th>
                <th rowspan="2" class="tt-unidentified">Неопознанные</th>
                <th rowspan="2" class="tt-all">Всего</th>
            </tr>
            <tr>
                <th class="tt-truck-type-sm">До 5т</th>
                <th class="tt-truck-type-md">От 5 до 12т</th>
                <th class="tt-truck-type-lg">От 12 до 20т</th>
                <th class="tt-truck-type-xlg">Свыше 20т</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0;?>
            <?php foreach ($traffics as $traffic):?>
                <?php if(is_array($traffic[0])):?>
                <?php $i++?>
                    <tr>
                        <td class="tt-day"><?php echo $i?></td>
                        <td class="tt-clock"><img src="/img/icons/chart-icon.png" alt=""></td>
                        <td class="tt-car"><?php echo $traffic[0]['Car'] + $traffic[1]['Car']?></td>
                        <td class="tt-bus"><?php echo $traffic[0]['Bus'] + $traffic[1]['Bus']?></td>
                        <td class="tt-truck-type-sm"><?php echo $traffic[0]['Struck'] + $traffic[1]['Struck']?></td>
                        <td class="tt-truck-type-md"><?php echo $traffic[0]['Mtruck'] + $traffic[1]['Mtruck']?></td>
                        <td class="tt-truck-type-lg"><?php echo $traffic[0]['Ltruck'] + $traffic[1]['Ltruck']?></td>
                        <td class="tt-truck-type-xlg"><?php echo $traffic[0]['Btruck'] + $traffic[1]['Btruck']?></td>
                        <td class="tt-unidentified"></td>
                        <td class="tt-all"><?php echo $traffic[0]['AllT'] + $traffic[1]['AllT']?></td>
                    </tr>
                    <?php endif;?>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>

</section>
<!-- end traffic-table.html-->