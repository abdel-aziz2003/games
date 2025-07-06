<?php

namespace App;

class GameMonetize
{
    var $url = 'https://gamemonetize.com/feed.php?format=0&num=500&page=';
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function get_games($page)
    {
        $URL = $this->url.$page;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$URL);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //this will not echo curl_exec($ch)
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt( $ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: Basic cHJvaW5zOkFyY2hpMTkxNGJvbmc=')
        );
        $result=curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
        //echo curl_error($ch);
        curl_close ($ch);
        //echo $status_code;
        
        $result = json_decode($result, 'true');
        //print_r($result);
        $res = $result;

        return $res;

    }


}
