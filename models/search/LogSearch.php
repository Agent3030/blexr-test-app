<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Log;

/**
 * LogSearch represents the model behind the search form of `app\models\Log`.
 */
class LogSearch extends Log
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at'], 'integer'],
            [['odds_uk', 'ip', 'hostname', 'org', 'loc', 'city', 'region', 'country'], 'safe'],
            [['odds_eu', 'odds_usa'], 'number'],
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
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Log::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'odds_eu' => $this->odds_eu,
            'odds_usa' => $this->odds_usa,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['ilike', 'odds_uk', $this->odds_uk])
            ->andFilterWhere(['ilike', 'ip', $this->ip])
            ->andFilterWhere(['ilike', 'hostname', $this->hostname])
            ->andFilterWhere(['ilike', 'org', $this->org])
            ->andFilterWhere(['ilike', 'loc', $this->loc])
            ->andFilterWhere(['ilike', 'city', $this->city])
            ->andFilterWhere(['ilike', 'region', $this->region])
            ->andFilterWhere(['ilike', 'country', $this->country]);

        return $dataProvider;
    }
}
