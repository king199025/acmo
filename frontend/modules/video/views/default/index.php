<?php
/**
 * @var $this \yii\web\View
 * @var $photos array
 * @var $meteo array
 */
?>

<!-- start video-review.html-->
<section class="video-review">
    <div class="content video-review__content">
        <?php foreach ($photos as $id => $photo):?>
            <a href="<?php echo \yii\helpers\Url::to(['/video/view', 'id' => $id])?>">
            <figure class="video-review__item">
                <img src="<?php echo $photo[0]?> " alt="">
                <figcaption><?php echo $meteo[$id]['METEO_NAME']?></figcaption>
            </figure></a>
        <?php endforeach;?>
    </div>
</section>
<!-- end video-review.html-->