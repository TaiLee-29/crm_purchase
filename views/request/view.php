<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $images array*/

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$countImg = count($images);
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
        ],
    ]);


  ?>

    <?php  if ($countImg == 1){
        echo Html::img('@web/uploads/'.$images[0]['path_to_file'], ['alt' => 'ewewe']);
    }
    else if ($countImg == 2){
        echo Html::img('@web/uploads/'.$images[0]['path_to_file'], ['alt' => 'ewewe']);
        echo Html::img('@web/uploads/'.$images[1]['path_to_file'], ['alt' => 'ewewe']);
    }else if ($countImg == 3){
        echo Html::img('@web/uploads/'.$images[0]['path_to_file'], ['alt' => 'ewewe']);
        echo Html::img('@web/uploads/'.$images[1]['path_to_file'], ['alt' => 'ewewe']);
        echo Html::img('@web/uploads/'.$images[2]['path_to_file'], ['alt' => 'ewewe']);
    } else if ($countImg == 4){
        echo Html::img('@web/uploads/'.$images[0]['path_to_file'], ['alt' => 'ewewe']);
        echo Html::img('@web/uploads/'.$images[1]['path_to_file'], ['alt' => 'ewewe']);
        echo Html::img('@web/uploads/'.$images[2]['path_to_file'], ['alt' => 'ewewe']);
        echo Html::img('@web/uploads/'.$images[3]['path_to_file'], ['alt' => 'ewewe']);
    } else{
        echo 'no images for this request';
    }?>




</div>
