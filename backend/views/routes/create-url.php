<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RouteUrls */

$this->title = 'Create Route Url';
$this->params['breadcrumbs'][] = ['label' => 'Routes', 'url' => ['routes/index']];
$this->params['breadcrumbs'][] = ['label' => $route->route, 'url' => ['routes/view', 'id' => $route->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-urls-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-url', [
        'model' => $model,
    ]) ?>

</div>
