<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Odds */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="odds-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'odds_uk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'odds_eu')->textInput() ?>

    <?= $form->field($model, 'odds_usa')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
