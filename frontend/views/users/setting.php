<?php
/**
 * @var $this \yii\web\View
 * @var $user \frontend\models\user\UserDec
 */
?>
<div class="row">
    <h1>Пользователь</h1>
    <div class="clo-md-6">
        <?= \yii\widgets\DetailView::widget([
            'model' => $user,
            'attributes' => [
                'email',
                'username',
                'profile.name',
                'profile.timezone',
                [
                    'label' => 'Доступные Источники',
                    'value' => implode(', ', $user->getRegions()->select('name')->column())
                ]
            ]
        ])?>
    </div>
</div>
