<?php
?>

<?php if (!Yii::$app->user->isGuest): ?>
    <aside class="sidebar">
        <ul>
            <li><a href="/"><img src="/img/icons/map.png" alt="map"></a></li>
            <li><a href="<?php echo \yii\helpers\Url::to(['/weather'])?>"><img src="/img/icons/thermometer.png" alt="thermometer"></a></li>
            <li><a href="<?php echo \yii\helpers\Url::to(['/video'])?>"><img src="/img/icons/camera.png" alt="camera"></a></li>
            <li><a href="<?php echo \yii\helpers\Url::to(['/traffic'])?>"><img src="/img/icons/cars.png" alt="cars"></a></li>
        </ul>
    </aside>
<?php endif;