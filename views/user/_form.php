<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, Yii::t('app', 'username'))->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Yii::t('app', 'password'))->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, Yii::t('app', 'email'))->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
