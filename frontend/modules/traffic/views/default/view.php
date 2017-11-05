<?php
/**
 * @var $this \yii\web\View
 * @var $traffic array
 * @var $photo array
 * @var $next integer
 * @var $prev integer
 * @var $name string
 */

?>


<!-- start traffic-data.html-->
<section class="traffic-data">
    <!-- start header-section.html-->
    <div class="s-header">
        <div class="s-header__side">
            <a href="<?php echo \yii\helpers\Url::to(['/traffic/view', 'id' => $prev])?>" class="btn btn-left"></a>
            <a href="<?php echo \yii\helpers\Url::to(['/traffic/view', 'id' => $next])?>" class="btn btn-right"></a>
            <span><?php echo $name?></span>
        </div>
<?php if(is_array($traffic[0])):?>
        <div class="s-header__side">
            <a href="<?php echo \yii\helpers\Url::to(['/traffic/archive', 'id' => $traffic[0]['TM_ID']])?>" class="btn">Архив</a>
            <a href="<?php echo \yii\helpers\Url::to(['/traffic/view', 'id' => $traffic[0]['TM_ID']])?>" class="btn">Текущие</a>
        </div>
    </div>
    <!-- end header-section.html-->
    <div class="content">
        <div class="traffic-data__video">
            <?php echo \frontend\widgets\SliderWidget::widget(['photo' => $photo, 'date' => $traffic[0]['TM_DATE']])?>

            <div class="cars-type">
                <div>
                    <p>Легковые</p>
                    <span><?php echo ($traffic[0]['Car']) ? $traffic[0]['Car'] : 0?></span>
                    <span><?php echo ($traffic[1]['Car']) ? $traffic[1]['Car'] : 0?></span>
                </div>
                <div>
                    <p>Грузовые</p>
                    <span><?php echo \common\models\AcmoApi::getTrucksCount($traffic[0])?></span>
                    <span><?php echo \common\models\AcmoApi::getTrucksCount($traffic[1])?></span>
                </div>
                <div>
                    <p>Автобусы</p>
                    <span><?php echo ($traffic[0]['Bus']) ? $traffic[0]['Bus'] : 0?></span>
                    <span><?php echo ($traffic[1]['Bus']) ? $traffic[1]['Bus'] : 0?></span>
                </div>

            </div>
        </div>
        <div class="traffic-data__statistics">
            <div class="traffic-data--block">
                <div>
                    <h3 class="bg-green"><?php echo ($traffic[0]['Occ']) ? $traffic[0]['Occ'] : 0?></h3>
                    <p>Средняя скорость движения, км./час<b><?php echo ($traffic[0]['S']) ? $traffic[0]['S'] : 0?></b></p>
                    <p>Объем движения, авт./сутки<b>204</b></p>
                </div>
                <div>
                    <h3 class="bg-yellow"><?php echo ($traffic[1]['Occ']) ? $traffic[1]['Occ'] : 0?></h3>
                    <p>Средняя скорость движения, км./час<b><?php echo ($traffic[1]['S']) ? $traffic[1]['S'] : 0?></b></p>
                    <p>Объем движения, авт./сутки<b>106</b></p>
                </div>
            </div>
            <ul class="traffic-data--review">
                <li><span class="bg-red"></span>Остановки в движении</li>
                <li><span class="bg-yellow"></span>Медленное движение</li>
                <li><span class="bg-green"></span>Бесперебойное движение</li>
                <li><span class="bg-grey"></span>Нет данных</li>
            </ul>
        </div>
    </div>
</section>
<!-- end traffic-data.html-->
<?php else :?>
<h1>Ничего не найдено</h1>
<?php endif;?>