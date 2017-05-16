<?php
/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 14.05.17
 * Time: 18:52
 */

namespace app\components\GeoIp;

use yii\base\Model;

/**
 * Class GeoIpAdapter
 * Adapter to use ipinfo Api client with standart models
 * @package app\components\GeoIp
 * @property array $loc
 * @property string $ip
 * @property string $hostname
 * @property string $org
 * @property string $city
 * @property string $country
 * @property string $region
 */

class GeoIpAdapter extends Model
{
    /**
     * @var array
     */
    public $loc=[];
    /**
     * @var string
     */
    public $ip;
    /**
     * @var string
     */
    public $hostname;
    /**
     * @var string
     */
    public $org;
    /**
     * @var string
     */
    public $city;
    /**
     * @var string
     */
    public $country;
    /**
     * @var string
     */
    public $region;
    /**
     * @var string
     */
    public $apiClass = 'app\components\GeoIp\GeoIp';
    /**
     * @var GeoIp
     */
    protected $apiClient;
    /**
     * @var \stdClass
     */
    protected $apiResponse;
    /**
     * Initialize Api response data
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\HttpException
     */
    public function init()
    {
        $this->apiClient = \Yii::createObject([
            'class' => $this->apiClass
        ]);
        $this->apiResponse = $this->apiClient->getResponse();
        $locArr = explode(',', $this->apiResponse->loc);
        $this->loc = json_encode([
            'lat' =>$locArr[0],
            'lng' =>$locArr[1]
        ]);
        $this->ip = $this->apiResponse->ip;
        $this->hostname = $this->apiResponse->hostname;
        $this->org = $this->apiResponse->org;
        $this->city =  $this->apiResponse->city;
        $this->region =  $this->apiResponse->region;
        $this->country =  $this->apiResponse->country;
    }

}