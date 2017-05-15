<?php
/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 14.05.17
 * Time: 18:52
 */

namespace app\components\GeoIp;


use yii\base\Model;

class GeoIpAdapter extends Model
{
    public $loc=[];
    public $ip;
    public $hostname;
    public $org;
    public $city;
    public $country;
    public $region;

    public $apiClass = 'app\components\GeoIp\GeoIp';
    protected $apiClient;
    protected $apiResponse;

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