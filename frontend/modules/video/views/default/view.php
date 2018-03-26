<?php
/**
 * @var $this \yii\web\View
 * @var $photos array
 * @var $meteo array
 * @var $prev integer
 * @var $next integer
 */
?>

<!-- start video-archive.html-->
<section class="video-archive">
    <!-- start header-section.html-->
    <div class="s-header">
        <div class="s-header__side">
            <a href="<?php echo \yii\helpers\Url::to(['/video/view', 'id' => $prev])?>" class="btn btn-left"></a>
            <a href="<?php echo \yii\helpers\Url::to(['/video/view', 'id' => $next])?>" class="btn btn-right"></a>
            <span><?php echo $meteo['METEO_NAME']?></span>
        </div>

    </div>

    <div class="filter">
        <span>Дата: </span><input class="date" data-pdk-id="<?= $meteo['METEO_ID']?>" type="date" value="<?= date('Y-m-d', ($_GET['date']) ? strtotime($_GET['date']) : time())?>">
    </div>

    <div class="content video-archive__content">
        <?= $this->render('elements/photo', ['meteo' => $meteo, 'photos' => $photos])?>
    </div>


</section>
<!-- end video-archive.html-->