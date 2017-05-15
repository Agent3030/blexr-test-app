<?php
/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 15.05.17
 * Time: 14:52
 */
use yii\helpers\Html;
?>
<?php \yii\bootstrap\Modal::begin([
    'id' => 'about',
    'header'=>'<h4><strong>About</strong></h4>',
    'headerOptions'=>[
        'class' => 'site-modal-header'
    ]
])?>
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">About!</h4>
            <h5 class="text-center"><strong>This is a Blexr test task. Betting Odds modal calculator.</strong></h5>
            <dl class="dl-horizontal">
                <dt>Name:</dt>
                <dd>Dmitry Zozulya</dd>
                <dt>Date:</dt>
                <dd><?=Yii::$app->formatter->asDatetime('15.05.2017 11:20')?></dd>
                <dt>Technologies:</dt>
                <dd>PHP, Yii2 framework basic, Postgres SQL, Javascript, Jquery,
                    HTML5, CSS3, Gulp, SASS, Docker</dd>
                <dt>GIT:</dt>
                <dd></dd>
                <dt>Demo page:</dt>
                <dd></dd>
            </dl>
        </div>
        <div class="col-md-12 text-center">
            <?= Html::button('Close', ['class'=>'btn btn-primary','data-dismiss'=>'modal'])?>
        </div>

    </div>

<?php \yii\bootstrap\Modal::end();
