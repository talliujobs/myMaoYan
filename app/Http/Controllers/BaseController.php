<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BaseController extends Controller
{
    protected function getContent($url, $isPost = false, $postData = '')
    {
        $curlobj = curl_init();            // 初始化

        curl_setopt($curlobj, CURLOPT_URL, $url);        // 设置访问网页的URL

        curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, 1); // 收集结果而非直接展示

// Cookie相关设置，这部分设置需要在所有会话开始之前设置
//        date_default_timezone_set('PRC'); // 使用Cookie时，必须先设置时区
//        curl_setopt($curlobj, CURLOPT_COOKIESESSION, TRUE);

        curl_setopt($curlobj, CURLOPT_HEADER, 0);
        curl_setopt($curlobj, CURLOPT_FOLLOWLOCATION, 1); // 这样能够让cURL支持页面链接跳转


        if ($isPost) {


            curl_setopt($curlobj, CURLOPT_POST, 1);
//            curl_setopt($curlobj, CURLOPT_POSTFIELDS, http_build_query($postData));
            curl_setopt($curlobj, CURLOPT_POSTFIELDS, $postData);
//            curl_setopt($curlobj, CURLOPT_HTTPHEADER, array("application/x-www-form-urlencoded; charset=utf-8", "Content-length: " . strlen($data)));

//            var_dump($url);
//            var_dump($postData);
        } else {
            curl_setopt($curlobj, CURLOPT_POST, 0);
        }

        $output = curl_exec($curlobj);    // 执行
        curl_close($curlobj);
        return $output;
    }

}
