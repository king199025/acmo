<?php
/**
 * @var $popupWindow array
 */
?>
<?php if (Yii::$app->session->get('pdk_id') || Yii::$app->request->cookies->get('pdk_id')): ?>
    <section class="map">
        <div id="acMap"></div>
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
