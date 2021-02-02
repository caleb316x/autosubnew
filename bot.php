<?php
    ini_set('max_execution_time', 0);
    $cid = "UCLe_RrkhnWJOXRR6NiLRtfQ";
    // $cid = "UCt1CtCER_N5AuNLP2vsbtog";
    $domains = [
        "www.subpals.com",
        "www.sonuker.com",
        "www.ytpals.com",
    ];
    $site = "";
    $cookies = array(
        "__cfduid=d73ee4baa9e729b9abcc34dbc7371f5971612253098; PHPSESSID=a430f19ac03d7ddb570c9aa0abde373b",
        "__cfduid=d2f4e0c6ee174a128e30ca26014c72d4c1612253263; PHPSESSID=e0da6fff199539c2fd67640b99b65321",
        "__cfduid=d6f11a7782dc7546c0cd5f2447ea37c861612253470; PHPSESSID=a07d9abf39753e9b1666e9b6a3056126"
    );
    $count = 0;
    $chkcount = true;

    echo "Choose Which Site to Login\n";
    for($x = 0; $x < count($domains); $x++){
        echo "[".($x+1)."] ".$domains[$x]."\n";
    }

    $sel_site = readline("Enter number: ");

    $site = $domains[$sel_site - 1];
    $cookie = $cookies[$sel_site - 1];


    function get_count(){
        global $cid,$site,$chkcount,$cookie;
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://$site/members-area/activate/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 500,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        // CURLOPT_POSTFIELDS => "activate=2",
        CURLOPT_HTTPHEADER => array(
            "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
            "accept-language: en-US,en;q=0.9",
            "cache-control: max-age=0,no-cache",
            "content-type: application/x-www-form-urlencoded",
            "origin: https://$site",
            "referer: https://$site/members-area/activate/",
            "sec-fetch-mode: nested-navigate",
            "sec-fetch-site: same-origin",
            "sec-fetch-user: ?1",
            "upgrade-insecure-requests: 1",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.74 Safari/537.36",
            "cookie: $cookie"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        // echo $response;

        // $dom = new DOMDocument();
        // @$dom->loadHTML($response);
        // $xp = new DOMXpath($dom);
        // $vid = $xp->query('//div[@id="remainingHint"]');

        // $v = $vid->item(0);
        // print_r($v);

        // // $vi = $v->getAttribute('src');

        // print("Video left: ");
        // print($v->nodeValue);

        preg_match_all("/html\(\'(.*?)\'\)/",$response,$match);
        // echo $match[1][1];
        // preg_match_all("/channel\s*\=\s*[\"](.*?)[\"]/",$response,$chid);
        // // print_r($chid);        
        // preg_match_all("/videoId\s*\=\s*[\"](.*?)[\"]/",$response,$vid);
        // // print_r($vid);

        // echo $match[1][1];
        
        // print_r(explode("-",$match[1][1]));
        
        // @$subs = explode("-",$match[1][1])[1];
        @$subs = intval($match[1][1]);
        // @$channel = $chid[1][0];
        // @$videoid = $vid[1][0];

        // echo $sub;

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
            // echo "End";
            if($chkcount){
                
                echo "Plan Requires ".($subs < 0? "0": $subs)." Subs to Activate\n";
                $chkcount = false;
            }

            if($subs != "" && $subs != " "){
                if($subs != 0){
                    sleep(2);

                    // echo "GET_SUB()";
                    get_subs($subs);
                }
                else{
                    echo "20 Subs Completed!";
                }
            }
            else{
                echo "Sub count not found | retry\n";
                sleep(2);
                get_count();
            }
        }
    }


    function get_subs($subs){
        global $cid,$site,$count,$cookie;

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://$site/members-area/sub-completed-v4.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 500,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "subscribers=1&channel=UCLe_RrkhnWJOXRR6NiLRtfQ&videoId=fRRoZnKVw4Q",
        CURLOPT_HTTPHEADER => array(
            "accept: application/json, text/javascript, */*; q=0.01",
            "accept-language: en-US,en;q=0.9",
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
            "origin: https://$site",
            "referer: https://$site/members-area/sub-completed-v4.php",
            "sec-fetch-mode: cors",
            "sec-fetch-site: same-origin",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.74 Safari/537.36",
            "x-requested-with: XMLHttpRequest",
            "cookie: $cookie"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $res = json_decode($response,true);

        curl_close($curl);

        echo "=============================\n";
        echo $response."\n";
        echo "=============================\n";
        // exit;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // echo $response;
            // if($response == ""){
            if($res && array_key_exists("status",$res)){
                if($res['status'] == "success"){
                    $count++;
                    echo ($subs > 9 ? $subs : "0".$subs)." | Sub Success\n";
                    sleep(2);
                    if($subs == 1){
                        echo "20 Subs Completed\n";
                        echo "Plan Acticated\n";
                    }
                    else{
                        get_count();
                    }
                }
                elseif($res['status'] == "activated"){
                    $count++;
                    echo ($subs > 9 ? $subs : "0".$subs)." | Sub Success\n";
                    echo "20 Subs Completed\n";
                    echo "Plan Activated\n";
                    exit;
                }
                else{
                    echo ($subs > 9 ? $subs : "0".$subs)." | Sub Failed | retry.. \n";
                    // echo "Channel: $channel \n";
                    // echo "Video ID: $videoid \n";
                    // echo "================================\n";
                    // echo $response."\n";
                    sleep(2);
                    get_subs($subs);
                }
            }
            else{
                echo "Plan Activated\n";
            }
        }
    }


    function checktimer(){
        global $site,$cookie;
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
        // exit;

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {

                if (strpos($response, 'Activate Now') !== false) {
                    echo "Plan Available\n";
                    activate_plan();
                }
                elseif (strpos($response, "Activated") !== false) {
                // elseif (strpos($response, "https://$site/network-v2/common/timer.php") !== false) {
                    $dom = new domdocument;
                    @$dom->loadHTML($response);
                    $src = "";
                    foreach ($dom->getElementsByTagName("iframe") as $a) {
                        // echo $a->getAttribute("src")."\n";
                        $src = $a->getAttribute("src");
                        break;
                    }

                    $parts = parse_url($src);
                    parse_str($parts['query'], $query);
                    $hours = $query['hours'];
                    $minutes = $query['minutes'];
                    $seconds = $query['seconds'];

                    echo "Plan still activated\n";
                    echo "Available again in : $hours hours $minutes minutes & $seconds seconds";
                }
                else{
                    echo "Starter Plan already activate\n";
                    echo "Getting Sub count..\n";
                    // get_subs();
                    sleep(3);
                    get_count();
                }
            

                // echo "TExt saved\n";
                // $file = fopen("text.html", "w");
                // fwrite($file,$response);
        }
    }

    function activate_plan(){
        global $cid,$site,$cookie;
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://$site/members-area/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 500,
        CURLOPT_COOKIEJAR => 'cookie.txt',
        CURLOPT_COOKIEFILE => 'cookie.txt',
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "activate=2",
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

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
            get_count();
            sleep(2);
        }
    }

    checktimer();
    // get_count();
?>