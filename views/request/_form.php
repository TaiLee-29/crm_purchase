<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?php if (Yii::$app->user->can('changeRequestStatus')) {
        echo $form->field($model, 'status')->dropDownList(['new' => 'New', 'pending' => 'Pending', 'accepted' => 'Accepted', 'declined' => 'Declined',], ['prompt' => '']);
    } ?>
    <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true,'accept' => '*']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
