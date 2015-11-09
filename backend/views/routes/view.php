<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Routes */

$this->title = $model->route;
$this->params['breadcrumbs'][] = ['label' => 'Routes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="routes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'user_id',
                'value' => $model->user->username,
            ],
            'route',
        ],
    ]) ?>

    <hr>

    <?= GridView::widget([
        'dataProvider' => $RouteUrlsDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'url',
            [
                'attribute' => 'created_at',
                'format' => 'date',
            ],
        ],
    ]); ?>

    <p>
        <?= Html::a('Add Url', ['routes/create-url', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>


</div>
