<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Purchase */


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Purchases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="purchase-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'description',
            'name',
            'price',
            'request_id',
            'image_files' =>
                [
                    'label' => 'Images',
                    'format' => 'raw',
                    'value' => function ( $model) {
                        $html = '';
                        foreach ($model->request->requestFiles as $file) {
                            $html .= Html::img('@web/uploads/' . $file->path_to_file, [
                                'alt' => 'yii2 - картинка в gridview',
                                'style' => 'width:180px;height:190px;'
                            ]);
                        }
                        return $html;
                    },
                ],
        ],
    ]) ?>




</div>
