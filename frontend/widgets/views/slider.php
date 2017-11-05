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
    <?php while (isset($photo[$i])):?>
        <?php $i++?>
        <img id="img<?php echo $i?>" class="tabcontent" src="<?php echo $photo[$i - 1]?>" alt="">
        <?php $buttons .= '<li class="tablinks"><a href="#img'.$i.'"></a></li>'?>
        <?php if($i >= 1) break?>
    <?php endwhile;?>
    <div>
        <span></span>
        <?php echo $date?>
        <ul>
            <?php echo $buttons?>
        </ul>
    </div>

</div>

