<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Odds;
use yii\web\HttpException;

/**
 * OddsSearch represents the model behind the search form of `app\models\Odds`.
 * Using for search data by selected form field
 */
class OddsTypeSearch extends Odds
{
    public $label;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'integer'],
            ['label', 'string'],
            [['odds_uk'], 'safe'],
            [['odds_eu', 'odds_usa'], 'number']
        ];
    }
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $searchParams
     * @return ActiveDataProvider
     * @throws  HttpException
     */
    public function search(array $searchParams) : ActiveDataProvider
    {
        $query = Odds::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if(isset($searchParams['label']) && array_key_exists('label',$searchParams)){
            $odds = Odds::$oddsLabels[$searchParams['label']];
            $this->setAttributes([
                $odds => $searchParams['value'],
                'label' => $searchParams['label']
            ], false);
        } else
            throw new HttpException(503, 'Odds type not set');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions

            $query->orFilterWhere([
                'id' => $this->id,
                'odds_eu' => $this->odds_eu,
                'odds_usa' => $this->odds_usa,

            ]);

            $query->orFilterWhere(['like', 'odds_uk', $this->odds_uk]);

        return $dataProvider;
    }


}
