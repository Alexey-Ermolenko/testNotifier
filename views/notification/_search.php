<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NotificationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'text') ?>

    <?= $form->field($model, 'integrator') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'send_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
