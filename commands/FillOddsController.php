<?php
/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 13.05.17
 * Time: 16:48
 */

namespace app\commands;


use app\components\BettingOdds;
use app\models\Odds;
use yii\console\Controller;
use yii\console\Exception;

/**
 * Class FillOddsController
 * Console controller for fill
 * @package app\commands
 */

class FillOddsController extends Controller
{
    public function actionIndex()
    {
        $model = new BettingOdds();
        try {
            $model->saveToDb();
        } catch(\Throwable $e){
            throw new Exception($e);
        }
    }
}