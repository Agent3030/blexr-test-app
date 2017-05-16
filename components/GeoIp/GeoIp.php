<?php
/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 14.05.17
 * Time: 9:43
 */

namespace app\components\GeoIp;

use yii\base\Component;
use yii\web\HttpException;

/**
 * Class GeoIp
 * API client for ipinfo.io
 * @package app\components\GeoIp
 * @property integer $ip
 */

class GeoIp extends Component
{
    const GEO_API_URL = 'http://ipinfo.io';


    /**
     * @var
     */
    public $ip;
    /**
     * @var
     */
    private $format;

    public function init()
    {
        $this->ip = \Yii::$app->request->getUserIP();
        $this->format = 'json';
    }

    /**
     * get Api response object
     * @return \stdClass
     * @throws HttpException
     */

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