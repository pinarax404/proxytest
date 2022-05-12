<?php

echo '1. HTTP' . PHP_EOL . '2. HTTPS' . PHP_EOL . '3. SOCKS4' . PHP_EOL . '4. SOCKS5' . PHP_EOL;
$prxtype = fopen('php://stdin', 'rb');
$prxtypeline   = fgets($prxtype);
if(trim($prxtypeline) == '1') {
        echo 'masukkan host:port' . PHP_EOL;
        $handle = fopen('php://stdin', 'rb');
        $line   = fgets($handle);
        if(trim($line) !== null) {
                pinarax_start('1', trim($line));
        } else {
                die();
        }
        fclose($handle);
} else if(trim($prxtypeline) == '2') {
        echo 'masukkan host:port' . PHP_EOL;
        $handle = fopen('php://stdin', 'rb');
        $line   = fgets($handle);
        if(trim($line) !== null) {
                pinarax_start('2', trim($line));
        } else {
                die();
        }
        fclose($handle);
} else if(trim($prxtypeline) == '3') {
        echo 'masukkan host:port' . PHP_EOL;
        $handle = fopen('php://stdin', 'rb');
        $line   = fgets($handle);
        if(trim($line) !== null) {
                pinarax_start('3', trim($line));
        } else {
                die();
        }
        fclose($handle);
} else if(trim($prxtypeline) == '4') {
        echo 'masukkan host:port' . PHP_EOL;
        $handle = fopen('php://stdin', 'rb');
        $line   = fgets($handle);
        if(trim($line) !== null) {
                pinarax_start('4', trim($line));
        } else {
                die();
        }
        fclose($handle);
} else {
        die();
}
fclose($prxtype);

function pinarax_start($ptype, $proxy) {
    $exex_http      = pinarax_curl_attr($ptype, $proxy, 'http://ip-api.com/json/');
    $exex_https     = pinarax_curl_attr($ptype, $proxy, 'https://ipwhois.app/json/');
    $exex_rand      = pinarax_curl_attr($ptype, $proxy, 'https://randomuser.me/api/?gender=female&nat=us');
    $exex_ig_mid    = pinarax_curl_attr($ptype, $proxy, 'https://www.instagram.com/data/shared_data/');
    $exex_ig_api    = pinarax_curl_attr($ptype, $proxy, 'https://i.instagram.com/data/manifest.json');

    if($exex_http !== false  && strpos($exex_http, 'query') !== false) {
        echo "\033[1;37mHTTP : \033[1;32m✔\033[1;37m\n";
    } else {
        echo "\033[1;37mHTTP : \033[1;33m✘\033[1;37m\n";
    }

    if($exex_https !== false  && strpos($exex_https, 'ip') !== false) {
        echo "\033[1;37mHTTPS : \033[1;32m✔\033[1;37m\n";
    } else {
        echo "\033[1;37mHTTPS : \033[1;33m✘\033[1;37m\n";
    }

    if($exex_rand !== false  && strpos($exex_rand, 'results') !== false) {
        echo "\033[1;37mRandomuser : \033[1;32m✔\033[1;37m\n";
    } else {
        echo "\033[1;37mRandomuser : \033[1;33m✘\033[1;37m\n";
    }

    if($exex_ig_mid !== false  && strpos($exex_ig_mid, 'csrf_token') !== false) {
        echo "\033[1;37mIG mid : \033[1;32m✔\033[1;37m\n";
    } else {
        echo "\033[1;37mIG mid : \033[1;33m✘\033[1;37m\n";
    }

    if($exex_ig_api !== false  && strpos($exex_ig_api, 'Instagram') !== false) {
        echo "\033[1;37mIG api : \033[1;32m✔\033[1;37m\n";
    } else {
        echo "\033[1;37mIG api : \033[1;33m✘\033[1;37m\n";
    }
}

function pinarax_curl_attr($ptype, $proxy, $url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
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
        return $respons_data;
    } else {
        return false;
    }
}
