<?php
/**
 * @var $this \yii\web\View
 * @var $photo array
 * @var $date string
 */
?>
<div class="video">
    <?php $i = 0?>
    <?php $buttons = ''?>
    <?php while (isset($photo[$i]) && ($i <= 7)):?>
        <img id="img<?php echo $i?>" class="tabcontent" src="<?= $photo[$i]['url']?>" alt="">
        <?php $buttons .= '<li class="tablinks"><a href="#img'.$i.'" data-date="' . $photo[$i]['date'] . '"></a></li>'?>
        <?php $i++?>
    <?php endwhile;?>
    <div>
        <span></span>
        <strong id="photo-date"><?php echo $photo[0]['date']?></strong>
        <ul>
            <?php echo $buttons?>
        </ul>
    </div>

</div>

