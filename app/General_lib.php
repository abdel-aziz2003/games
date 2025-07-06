<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;

function filter($filter)
{
    $data = [];
    $and = '';
    $vfilter = '';
    //echo $filter;
    $exp = explode('--', $filter);

    foreach ($exp as $item) {
        $exp2 = explode('__', $item);

        if ($exp2[0] == 'search') {
            if (Route::currentRouteName() == 'game') {
                $and = $and . " and (title like '%$exp2[1]%' or description like '%$exp2[1]%') ";
            } else {
                $and = $and . " and name like '%$exp2[1]%' ";
            }
            $vfilter = $vfilter . "<small class='text-danger'>Search: </small>$exp2[1] | ";
        }

        if ($exp2[0] == 'category') {
            $and = $and . " and category_id = $exp2[1] ";
            $category_info = Category::find($exp2[1]);
            $vfilter = $vfilter . "<small class='text-danger'>Category: </small>" . $category_info->name . " | ";
        }
        if ($exp2[0] == 'drange') {
            $dexp = explode(' - ', $exp2[1]);
            $st = $dexp[0] . " 00:00:01";
            $et = $dexp[1] . " 23:59:59";
            $and = $and . " and created_at >= '$st' and created_at <= '$et' ";
            $vfilter = $vfilter . "<strong>Date Range: </strong>" . $exp2[1] . ' | ';
        }
    }

    if ($vfilter != '') {
        $vfilter = substr($vfilter, 0, -3);
    }

    $data['and'] = $and;
    $data['vfilter'] = $vfilter;
    //print_r($data);
    //exit;
    return $data;
}

function ref()
{
    $ref = uniqid();
    return $ref;
}

function validate_captcha($captcha)
{
    //check captcha
    $data = array(
        "secret" => config('settings')->g_secret_key,
        "response" => "$captcha"
    );
    //echo $data_string;
    $ch = curl_init("https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $result = curl_exec($ch);
    $result = json_decode($result, true);
    //$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
    //echo curl_error($ch);
    //echo $status_code;
    //print_r($result);

    //return $result;
    if ($result['success'] == true) {
        return true;
    } else {
        return false;
    }
}
