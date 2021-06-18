<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */
$this->title = 'Create new user';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to create new user:</p>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, Yii::t('app', 'username'))->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, Yii::t('app', 'email'))->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, Yii::t('app', 'password'))->passwordInput(['maxlength' => true]) ?>
            <div class="form-group">
                <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
