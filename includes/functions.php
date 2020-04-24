<?php

function getPetFinderToken($PFD_API_KEY,$PFD_SEC){

    // todo: singleton
    $res = _httpPost("https://api.petfinder.com/v2/oauth2/token", array(
        "grant_type" => "client_credentials",
        "client_id" => $PFD_API_KEY,
        "client_secret" => $PFD_SEC));
    $token = json_decode(explode("==", $res)[1])->{'access_token'};
    return $token;
}