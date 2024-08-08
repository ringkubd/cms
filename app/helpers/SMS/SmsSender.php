<?php
/**
 * Created by PhpStorm.
 * User: abzalali
 * Date: 12/03/2019
 * Time: 10:28 AM
 */

namespace App\helpers\SMS;

use App\helpers\SMS\GuzzleFacad;
use Illuminate\Support\Str;

class SmsSender
{
    private  $apiKey = "$2y$10" . '$nExBNtfJsE6FjJteRHqMyOIf3tDDRzi95Zt1yGo7qMfbu6uWGk5ja10';
    private $baseUrl = 'http://sms.greenheritageit.com/smsapi';

    public function makeUrl($mobile,$message){
        $messageId = Str::random(16);
//        return $url = "http://116.212.108.50/BulkSMSAPI/BulkSMSExtAPI.php?SendFrom=IDB-BISEW&SendTo={$mobile}&InMSgID={$messageId}&AuthToken=aWRiYnw3MTIxMzE&Msg={$message}";
        return $this->baseUrl.'?apiKey='.$this->apiKey.'&maskName=IsDB BISEW'.'&mobileNo='.$mobile.'&message='.$message;
    }

    /**
     * @param $mobile
     * @param $message
     * @return array
     */
    public function sendSms($mobile,$message){
        $get = GuzzleFacad::get($this->makeUrl($mobile, $message));
        return $get->getBody()->getContents();
    }
}
