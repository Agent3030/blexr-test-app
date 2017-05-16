<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%odds}}".
 *
 * @property int $id
 * @property string $odds_uk
 * @property double $odds_eu
 * @property int $odds_usa
 */
class Odds extends \yii\db\ActiveRecord
{
    public static $oddsLabels = [
        'log-odds_uk' => 'odds_uk',
        'log-odds_eu' => 'odds_eu',
        'log-odds_usa' => 'odds_usa',
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%odds}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['odds_eu'], 'number'],
            [['odds_usa'], 'default', 'value' => null],
            [['odds_usa'], 'integer'],
            [['odds_uk'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'odds_uk' => 'Odds Uk',
            'odds_eu' => 'Odds Eu',
            'odds_usa' => 'Odds Usa',
        ];
    }
}
