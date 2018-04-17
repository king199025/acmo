<?php
/**
 * @var $meteo array
 * @var $photo array
 * @var $forecast array
 * @var $traffic array
 */
?>

<!-- start new-modal.html-->
<div class="modal">
    <h2 class="modal__title"><?= $meteo['METEO_NAME']?></h2>
    <div class="modal__slider">
        <?php foreach ($photo as $itemPhoto): ?>
            <?php $date = strtotime($itemPhoto['date']) ?>
            <div class="modal__slide">
                <img src="<?= $itemPhoto['url']?>" alt="place" class="modal__slide">
                <div class="modal__datetime">
                    <span><?= date('d.m.Y', $date)?></span>
                    <span><?= date('H:i:s', $date)?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="modal__table">
        <div class="modal__table-row">
            <div class="modal__table-cell">воздух</div>
            <div class="modal__table-cell">
            <?php if($meteo['weather']):?>
                <img src="img/icons/<?php echo \common\models\AcmoApi::$weather[$meteo['weather']]['img']?>" alt="">
            <?php endif;?>
            </div>
            <div class="modal__table-cell"><?= $meteo['T']?> °C</div>
        </div>
        <div class="modal__table-row">
            <div class="modal__table-cell">ветер</div>
            <div class="modal__table-cell">
                <img src="img/icons/wind-direction-dark.png" style="transform: rotate(<?php echo $meteo['DD']?>deg)" alt="">
            </div>
            <div class="modal__table-cell"><?= $meteo['FF']?> м\с</div>
        </div>
        <div class="modal__table-row">
            <div class="modal__table-cell">дорога</div>
            <div class="modal__table-cell"><?= \common\models\AcmoApi::$road_state[$meteo['road_state']]?></div>
            <div class="modal__table-cell"><?= $meteo['t_road']?> °C</div>
        </div>
    </div>
</div>