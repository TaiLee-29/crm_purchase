<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $images array */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


?>
<div class="request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>

    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'description',
            'created_by',
            'status',
            'created_at',
            'image_files'=>
                [
                    'label' => 'Image',
                    'format' => 'raw',
                    'value' => function ($images) {
                        foreach ($images as $image) {
                            return Html::img('@web/uploads/'. $image['path_to_file'], [
                                'alt' => 'yii2 - картинка в gridview',
                                'style' => 'width:15px;'
                            ]);
                        }
                    },
                ],
        ],

    ]);


    ?>

</div>
