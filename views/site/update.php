<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Odds */

$this->title = 'Update Odds: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Odds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="odds-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
