<?php
/**
 * @var $this \yii\web\View
 * @var $name string название ПДК
 * @var $prev integer номер следующей страницы
 * @var $next integer номер предидущей страницы
 * @var $url string урл
 */
?>

<div class="s-header__side">
    <a href="<?php echo \yii\helpers\Url::to([$url, 'id' => $prev])?>" class="btn btn-left"></a>
    <a href="<?php echo \yii\helpers\Url::to([$url, 'id' => $next])?>" class="btn btn-right"></a>
    <span><?php echo $name?></span>
</div>