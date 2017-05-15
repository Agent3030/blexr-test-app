<?php
/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 03.05.17
 * Time: 9:43
 */

namespace app\components\GeoIp;


use yii\base\Component;
use yii\web\HttpException;

class GeoIp extends Component
{
    const GEO_API_URL = 'http://ipinfo.io';



    public $ip;

    private $format;
    private $latLng;

    public function init()
    {
        $this->ip = \Yii::$app->request->getUserIP();
        $this->format = 'json';
    }

    public function getResponse() : \stdClass
    {
        if($this->ip){
            $response = \json_decode(file_get_contents(self::GEO_API_URL.'/'
                .$this->ip.'/'.$this->format));
            if($response){
                return $response;

            } else
                throw new HttpException(503, 'No answer from API!');

        } else
            throw new HttpException(503, 'IP address not set!');
    }

}