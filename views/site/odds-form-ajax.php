<?php
/**
 * view for /site/odds-form-ajax
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 14.05.17
 * Time: 19:53
 * @var $model app\models\Log
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<div class="modal-header modal-odds-header">
    <div class="row modal-header-top-line">
        <div class="col-md-11 col-lg-11 col-sm-11 col-xs-11 empty"></div>
        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 modal-close">
            <a href="#" data-dismiss="modal">
                <i class="fa fa-close fa-2x text-left"></i>
            </a>

        </div>
    </div>

    <div class="row modal-header-main">
        <div class="col-md-3">
            <a href="#"><img src="img/header_image.png" class="img img-responsive modal-header-img" alt="casino"></a>
        </div>
        <div class="col-md-6">
            <h4 class ="title">Betting odds tool</h4>
        </div>
    </div>
</div>
<div class="modal-body modal-odds-body">
    <div class="row">
        <div class="col-md-12">
            <h4>Betting odds calculator form</h4>
            <?php $form = ActiveForm::begin([
                'action' => '/site/odds-form-ajax',
                'validationUrl' => '/site/validation-odds-form',
                'layout' => 'horizontal',
                'options'=>[
                    'class' => 'col-md-10 col-md-offset-1 odds-search-form',
                ],
                'id' => 'odds-form',
                'fieldConfig' => [
                    'template' => "{label}\n{beginWrapper}\n{input}\n{endWrapper}\n{hint}\n{error}\n",
                    'horizontalCssClasses' => [
                        'label' => 'col-sm-6 col-md-6',
                        'offset' => 'col-sm-offset-1',
                        'wrapper' => 'col-md-4 col-md-offset-1  col-sm-4 col-sm-offset-1',
                        'error' => '',
                        'hint' => '',
                    ],
                ],
                'enableAjaxValidation' => true,
            ])?>


                <?= $form->field($model, 'odds_uk')->textInput(['placeholder'=>'1/5', 'class' => 'form-control text-center odds-input'])?>
                <div class="search-window" id="odds_uk_search" data-id="log-odds_uk">
                    <p></p>
                </div>


                <?= $form->field($model, 'odds_eu')->input('number',[
                    'placeholder'=>'1.2',
                    'class' => 'form-control text-center odds-input',
                    'min' =>'1.2',
                    'max' => '50',
                    'step' => '0.01'
                ])?>
                <div class="search-window" id="odds_eu_search" data-id="log-odds_eu">
                    <p></p>
                </div>


                <?= $form->field($model, 'odds_usa')->input('number',[
                    'placeholder'=>'-500',
                    'class' => 'form-control text-center odds-input',
                    'min' =>'-500',
                    'max' => '5000',
                    'step' => '0.5'
                ])?>
                <div class="search-window" id="odds_usa_search" data-id="log-odds_usa">
                    <p></p>
                </div>

                <div class="form-group">
                    <div class="col-md-12 col-sm-12 text-center">
                        <?= Html::submitButton('Send', ['class' => "btn btn-primary odds-submit"])?>
                    </div>
                </div>

            <?php ActiveForm::end() ?>
        </div>

    </div>


</div>
