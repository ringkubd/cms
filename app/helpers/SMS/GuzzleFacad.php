<?php
/**
 * Created by PhpStorm.
 * User: abzalali
 * Date: 12/03/2019
 * Time: 10:54 AM
 */
namespace App\helpers\SMS;
use Illuminate\Support\Facades\Facade as IlluminateFacade;

class GuzzleFacad extends  IlluminateFacade{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return $BanglaiNumber = new \GuzzleHttp\Client();
    }
}
