<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\HttpException;

/**
 * This is the model class for table "{{%log}}".
 *
 * @property int $id
 * @property string $odds_uk
 * @property double $odds_eu
 * @property double $odds_usa
 * @property string $ip
 * @property string $hostname
 * @property string $org
 * @property string $loc
 * @property string $city
 * @property string $region
 * @property string $country
 * @property int $created_at
 */
class Log extends \yii\db\ActiveRecord
{
    public $adapterClass = 'app\components\GeoIp\GeoIpAdapter';
    protected $adapter;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%log}}';
    }

    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => null
            ]
        ];
    }

    public function rules()
    {
        return [
            [['odds_eu', 'odds_usa'], 'number'],
            [['created_at'], 'default', 'value' => null],
            [['created_at'], 'integer'],
            [['odds_uk', 'ip', 'hostname', 'org', 'loc', 'city', 'region', 'country'], 'string', 'max' => 255],
            [['odds_uk', 'odds_eu', 'odds_usa'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'odds_uk' => 'Fractional Odds:',
            'odds_eu' => 'Decimal Odds:',
            'odds_usa' => 'Moneyline Odds:',
            'ip' => 'Ip',
            'hostname' => 'Hostname',
            'org' => 'Org',
            'loc' => 'Loc',
            'city' => 'City',
            'region' => 'Region',
            'country' => 'Country',
            'created_at' => 'Created At',
        ];
    }

    public function init()
    {
        $this->adapter = Yii::createObject($this->adapterClass);

    }

    public function saveLog(array $response) : bool
    {
        if($this->load($response)){

            $this->setAttributes($this->adapter->attributes, false);
            if(!$this->save()){
                throw new HttpException(503, 'Log Not Saved');
            }
            return true;
        } else
            return false;
    }


}
