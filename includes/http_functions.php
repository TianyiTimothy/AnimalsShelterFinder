<?php
function _httpGet($url = "")
{

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);
    curl_close($curl);

    return $res;
}

function _httpPost($url = "", $requestData = array())
{

    $curl = curl_init();

//    echo "sending post request to " . $url;
//    echo "request data: ";
//    var_dump($requestData);

    curl_setopt($curl, CURLOPT_URL, $url);
    // set header as data stream output
    curl_setopt($curl, CURLOPT_HEADER, 1);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // set method to post
    curl_setopt($curl, CURLOPT_POST, 1);

    curl_setopt($curl, CURLOPT_POSTFIELDS, $requestData);

    // execute
    $data = curl_exec($curl);

    curl_close($curl);

//    var_dump($data);
    return $data;
}