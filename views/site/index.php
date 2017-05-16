<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OddsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
\app\assets\ModalAsset::register($this);
$this->title = 'Odds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="odds-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Betting Odds Tool', ['#'], ['class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#odds-modal']) ?>
        <?= Html::a('Create Odds', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'odds_uk',
            'odds_eu',
            'odds_usa',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
