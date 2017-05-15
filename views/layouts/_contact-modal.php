<?php
/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 15.05.17
 * Time: 14:52
 */
use yii\widgets\ActiveForm;
?>
<?php \yii\bootstrap\Modal::begin([
    'id' => 'contact',
    'header'=>'<h4><strong>Contact Form!</strong></h4>',
    'headerOptions'=>[
        'class' => 'site-modal-header'
    ]
])?>
    <div class="modal-content"></div>

<?php \yii\bootstrap\Modal::end();
