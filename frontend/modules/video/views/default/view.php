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
        <!--<div class="s-header__side">
            <button class="btn">Архив</button>
            <button class="btn">Текущие</button>
            <button class="btn">Прогноз</button>
        </div>-->
    </div>
    <!-- end header-section.html-->
    <div class="content video-archive__content">
        <div class="video-archive__video">
            <div class="video">
                <img src="<?php echo current($photos)?>" alt="">
                <p><span></span><?php echo $meteo['WEATHER_DATE']?></p>
            </div>
            <div class="place-characteristics">
                <p class="wind-direction">
                    <span>Ветер</span>
                    <b><img src="img/icons/wind-direction.png" alt=""><?php echo $meteo['FF']?></b>
                </p>
                <p class="air-temperature">
                    <span>Воздух</span>
                    <b><?php echo $meteo['T']?> °С</b>
                </p>
                <p class="road-temperature">
                    <span>Дорога</span>
                    <b><?php echo $meteo['t_road']?> °С</b>
                </p>

            </div>
        </div>
        <div class="video-archive__items">
            <?php foreach ($photos as $photo) :?>
            <figure class="video-archive__item">
                <img src="<?php echo $photo?> " alt="">
                <figcaption><?php echo $meteo['METEO_NAME']?></figcaption>
            </figure>
            <?php endforeach;?>
        </div>
    </div>
</section>
<!-- end video-archive.html-->