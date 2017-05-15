<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Odds */

$this->title = 'Create Odds';
$this->params['breadcrumbs'][] = ['label' => 'Odds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="odds-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
