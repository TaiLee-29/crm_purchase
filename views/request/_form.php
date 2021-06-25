<?php

use app\widgets\upload\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, Yii::t('app', 'description'))->textInput(['maxlength' => true]) ?>

    <?php if (Yii::$app->user->can('changeRequestStatus')) {
        echo $form->field($model, Yii::t('app', 'status'))->dropDownList(['new' => 'New', 'pending' => 'Pending', 'accepted' => 'Accepted', 'declined' => 'Declined',], ['prompt' => 'new']);
    } ?>
    <?= $form->field($model, 'files')->label('Pictures')->widget(Upload::class,
        [
            'url' => ['file/upload'],
            'sortable' => true,
            'maxFileSize' => 10 * 1024 * 1024, // 10Mb

            'maxNumberOfFiles' => 4,
        ]
    ); ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
