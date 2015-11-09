<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RoutesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Routes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="routes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user_id',
                'value' => 'user.username',
            ],
            'route',
            [
                'attribute' => 'created_at',
                'format' => 'date',
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'date',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
