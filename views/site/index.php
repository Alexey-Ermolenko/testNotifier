<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['notification/index']); ?>">Перейти на оповещения</a></p>
    </div>

    <div class="body-content">
        <div class="row">

        </div>
    </div>
</div>
