<?php
/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 15.05.17
 * Time: 14:52
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">Contact Form</h4>
            <h5 class="text-center"><strong>You can leave message to me with your proposals hear!</strong></h5>

        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'subject') ?>

            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>


            <div class="form-group text-center">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

