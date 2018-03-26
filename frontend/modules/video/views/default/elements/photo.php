<?php
/**
 * @var $this \yii\web\View
 * @var array $photos
 * @var array $meteo
 */
?>



    <div class="video-archive__video">
        <div class="video">
            <img src="<?php echo current($photos)['url']?>" alt="">
            <p><span></span><?php echo current($photos)['date']?></p>
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
                <img src="<?php echo $photo['url']?> " alt="">
                <figcaption><?php echo $meteo['METEO_NAME']?></figcaption>
            </figure>
        <?php endforeach;?>
    </div>

