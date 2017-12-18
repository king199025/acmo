<?php
use yii\helpers\Url;
?>

<header class="header">

    <div class="header__logo">
        <span class="logo">Road Meter</span>
        <sup class="status">/online</sup>
    </div>

    <div class="header__actions">
        <div class="header__time">
            <span id="watch"></span>
        </div>
        <?php

        if (Yii::$app->user->isGuest): ?>
            <a href="<?= Url::toRoute('/login') ?>" class="header__btn">
                <img src="/img/icons/exit.png" alt="exit">
                <span>Войти</span>
            </a>
        <?php else: ?>
            <button class="header__btn"><img src="/img/icons/settings.png" alt="settings"></button>
            <a data-method="post" href="<?= Url::to(['/user/security/logout']) ?>" class="header__btn" >
                <img src="/img/icons/exit.png" alt="exit">
                <span>Выйти</span>
            </a>
        <?php endif; ?>
    </div>

</header>
