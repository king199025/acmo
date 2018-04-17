<?php
/**
 * @var $popupWindow array
 */
?>
<?php if (Yii::$app->session->get('pdk_id') || Yii::$app->request->cookies->get('pdk_id')): ?>
    <section class="map">
        <div id="acMap"></div>
        <div class="map__legend">
            <div class="map__item">
                <span class="map__indicator bg-red"></span>
                <span class="map__item-text">Лёд</span>
            </div>
            <div class="map__item">
                <span class="map__indicator bg-yellow"></span>
                <span class="map__item-text">Снег</span>
            </div>
            <div class="map__item">
                <span class="map__indicator bg-violet"></span>
                <span class="map__item-text">Иней</span>
            </div>
            <div class="map__item">
                <span class="map__indicator bg-blue"></span>
                <span class="map__item-text">Мокро</span>
            </div>
            <div class="map__item">
                <span class="map__indicator bg-light-green"></span>
                <span class="map__item-text">Влажно</span>
            </div>
            <div class="map__item">
                <span class="map__indicator bg-green"></span>
                <span class="map__item-text">Сухо</span>
            </div>
        </div>
    </section>
    <script>
        var mapData = <?= json_encode($popupWindow) ?>
    </script>
<?php else: ?>
    <div class="col-sm-6">
        <?php $form = \yii\widgets\ActiveForm::begin(['action' => '/mainpage/default/set-pdk']) ?>
        <?= \kartik\select2\Select2::widget([
            'data' => \common\models\Region::getUserRegionList(Yii::$app->user->id),
            'name' => 'region_id',
        ])?>
        <?= \yii\helpers\Html::submitButton('Выбрать', ['class' => 'btn btn primary'])?>
    <?php \yii\widgets\ActiveForm::end() ?>
    </div>
<?php endif; ?>
