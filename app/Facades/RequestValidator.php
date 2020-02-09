<?php

namespace App\Facades;

use Laravel\Lumen\Routing\ProvidesConvenienceMethods;
use App\Classes\ValidatorAbstract;

/**
 * Class RequestValidator
 * @package App\Classes
 * @author Apostolos Kourmatzoglou
 * @date 2020-02-08
 */
class RequestValidator extends ValidatorAbstract {

    use ProvidesConvenienceMethods;

    /**
     * Validate Quote
     * @param $request
     * @return array
     */
    public function validateRequestJson($request){

        return $this->validateRequest($request, [
            'mmsi' => 'required',
            'status' => 'required',
            'station' => 'required',
            'lon' => 'required',
            'lat' => 'required',
            'course' => 'required',
            'heading' => 'required',
            'rot' => 'required',
            'timestamp' => 'required'
        ]);
    }

     /**
     * Check if the same IP make the requests
     * 
     * @return boolean
     */
    public function validateTimeUserRequest()
    {
        $check = true;
        
        $ips = [];
        $date_string = date('Y-m-d H:m:i');

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        if (!isset($ips[$ip])) {
            $ips[$ip]['count'] = 0;
        } else {
            $ips[$ip]['count'] = +1;
        }

        if ($latestPost->created_at->diffInSeconds(Carbon\Carbon::now()) > (30 * 60 * 60)) {
            $check = false;
        }

        if ( $ips[$ip]['count'] > 10) {
            $check = false;
        }

        return $check;
    }
}
