<?php

$cookie = "__cfduid=d5a1a7196c7f809df0309924a62b13ac61612092545; PHPSESSID=26d9fd5a88d0f735b84104acdf0584e7; cookieaccepted=1; wp-mautic=e3a6bed0523ae9e6693b98dc40315271; sb-updates=3.1.3; shopmagic_visitor_84938ff465a7a5148a30ef3d43f9bfff=%7B%22meta%22%3A%5B%5D%2C%22hash%22%3A%22d80115171dfbf6f5f65237646cdc26bf%22%7D";
$site = "www.subpals.com";
function home(){
    global $site,$cookie,$new_cookie;
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://$site/members-area/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 11,
    CURLOPT_TIMEOUT => 500,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "accept: application/json, text/javascript, */*; q=0.01",
        "accept-language: en-US,en;q=0.9",
        "cache-control: no-cache",
        "content-type: application/x-www-form-urlencoded",
        "origin: https://$site",
        "referer: https://$site/members-area/",
        "sec-fetch-mode: cors",
        "sec-fetch-site: same-origin",
        "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.74 Safari/537.36",
        "x-requested-with: XMLHttpRequest",
        "cookie: $cookie"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    // echo $response;

}

home();

?>