<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: MINO
 * Date: 2018-05-30
 * Time: 오후 2:54
 */

class SyncEverland
{


    function getCoupon($nocoupon)
    {
        echo $nocoupon;
    }

    public function PostSync($nocoupon)
    {
        $apiurl="https://gateway.sparo.cc/everland/sync/".urlencode($nocoupon);

        //echo $apiurl."\n";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiurl);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1" );
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);

        $data = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        if($info['http_code'] == "200"){
            return $data;
        }else{
            return false;
        }
    }

    public function GetSync($nocoupon)
    {
        $apiurl="https://gateway.sparo.cc/everland/sync/".urlencode($nocoupon);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiurl);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1" );
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);

        $data = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        if($info['http_code'] == "200"){
            return $data;
        }else{
            return false;
        }
    }

    public function PatchSync($nocoupon)
    {
        $apiurl="https://gateway.sparo.cc/everland/sync/".urlencode($nocoupon);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiurl);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1" );
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);

        $data = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        if($info['http_code'] == "200"){
            return $data;
        }else{
            return false;
        }
    }

}