<?php

echo '1. HTTP' . PHP_EOL . '2. HTTPS' . PHP_EOL . '3. SOCKS4' . PHP_EOL . '4. SOCKS5' . PHP_EOL;
$prxtype = fopen('php://stdin', 'rb');
$prxtypeline   = fgets($prxtype);
if(trim($prxtypeline) == '1') {
        echo 'masukkan host:port' . PHP_EOL;
        $handle = fopen('php://stdin', 'rb');
        $line   = fgets($handle);
        if(trim($line) !== null) {
                pinarax_curl_attr('1', trim($line));
        } else {
                die();
        }
        fclose($handle);
} else if(trim($prxtypeline) == '2') {
        echo 'masukkan host:port' . PHP_EOL;
        $handle = fopen('php://stdin', 'rb');
        $line   = fgets($handle);
        if(trim($line) !== null) {
                pinarax_curl_attr('2', trim($line));
        } else {
                die();
        }
        fclose($handle);
} else if(trim($prxtypeline) == '3') {
        echo 'masukkan host:port' . PHP_EOL;
        $handle = fopen('php://stdin', 'rb');
        $line   = fgets($handle);
        if(trim($line) !== null) {
                pinarax_curl_attr('3', trim($line));
        } else {
                die();
        }
        fclose($handle);
} else if(trim($prxtypeline) == '4') {
        echo 'masukkan host:port' . PHP_EOL;
        $handle = fopen('php://stdin', 'rb');
        $line   = fgets($handle);
        if(trim($line) !== null) {
                pinarax_curl_attr('4', trim($line));
        } else {
                die();
        }
        fclose($handle);
} else {
        die();
}
fclose($prxtype);

function pinarax_curl_attr($ptype, $proxy) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://ipwhois.app/json/');
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    if($ptype == '1'){
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
    } else if($ptype == '2'){
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTPS);
    } else if($ptype == '3'){
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
    } else if($ptype == '4'){
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
    }
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    $respons_data = curl_exec($ch);
    $respons_header = substr($respons_data, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
    $respons_http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if($respons_http_code == 200) {
        $res_get_ip                 = json_decode($respons_data, true);
        echo "\033[1;37mIP : " . $res_get_ip['ip'] . " | Country : " . $res_get_ip['country'] . "\033[1;37m\n";
        pinarax_curl_attr($ptype, $proxy);
    } else {
        echo "\033[1;37mIP : null | Country : null\033[1;37m\n";
        pinarax_curl_attr($ptype, $proxy);
    }
}
