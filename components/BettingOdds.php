<?php
/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 13.05.17
 * Time: 8:11
 */

namespace app\components;

use app\models\Odds;
use yii\base\Component;
use yii\web\HttpException;

/**
 * Class BettingOdds
 * Create Betting Odds data table
 * @package app\components
 * @property array $oddsData
 */
class BettingOdds extends Component
{
    /**
     * @var array
     */
    public $oddsData = [];
    /**
     * @var float
     */
    private $oddsEu;
    /**
     * @var float
     */
    private $oddsUsa;

    /**
     * prepare odds array
     */
    public function init()
    {
        for($i=1; $i<=51; $i++){
            for($j=1; $j<=51; $j++){

                $this->oddsEu = round($i / $j + 1, 2);
                if ($this->oddsEu >= 1.2) {
                    if ($this->oddsEu <= 2) {
                        $this->oddsUsa = round($j / $i * (-100), 2);
                    } else {
                        $this->oddsUsa = round($i / $j * 100, 2);
                    }

                    $odds = [
                        'odds_uk' => $i . '/' . $j,
                        'odds_eu' => $this->oddsEu,
                        'odds_usa' => $this->oddsUsa
                    ];
                    if($this->oddsUsa >= -500) {
                        $this->oddsData[] = $odds;
                    }


                }

            }

        }
        $this->oddsData = $this->removeSame($this->oddsData, 'odds_usa');
        foreach($this->oddsData as $key => $value){
            $oddsEuAr[$key] = $value['odds_eu'];
        }

        array_multisort($oddsEuAr, SORT_ASC, $this->oddsData);
    }

    /**
     * Outputs calculated array
     * @return array
     */
    public function getOddsData() : array
    {
        return $this->oddsData;
    }
    /**
     * Save result to DB
     * @throws HttpException
     */
    public function saveToDb()
    {
        foreach($this->oddsData as $data){
            $model = new Odds();
            $model->odds_uk = $data['odds_uk'];
            $model->odds_eu = $data['odds_eu'];
            $model->odds_usa = $data['odds_usa'];
            if(!$model->save(false)){
                throw new HttpException('503','Odds not saved');
            }
        }
    }

    /**
     * @param array $array
     * @param string $key
     * @return array
     */
    protected function  removeSame(array $array, string $key) : array {
        $temp_array = [];
        $i = 0;
        $key_array = [];

        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }
}