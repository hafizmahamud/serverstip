<?php

function checkWebsiteUptime($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Perform the request
    curl_exec($ch);

    // Get HTTP status code
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $httpCode >= 200 && $httpCode < 400; // 2xx and 3xx are considered up
}

function getSslCertificateInfo($url) {
    $parsedUrl = parse_url($url);
    $host = $parsedUrl['host'];
    $port = isset($parsedUrl['port']) ? $parsedUrl['port'] : 443;

    $context = stream_context_create([
        "ssl" => [
            "capture_peer_cert" => true,
        ],
    ]);

    $socket = stream_socket_client("ssl://$host:$port", $errno, $errstr, 30, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $context);
    if ($socket === false) {
        return null;
    }

    $params = stream_context_get_params($socket);
    $cert = openssl_x509_parse($params['options']['ssl']['peer_certificate']);
    fclose($socket);

    return $cert;
}

$url = "https://www.moviesmod.day"; // Replace with your target URL

// Check website uptime
$isUp = checkWebsiteUptime($url);
echo "Website is " . ($isUp ? "up" : "down") . ".\n";

// Get SSL certificate information
$sslInfo = getSslCertificateInfo($url);
if ($sslInfo) {
    echo "SSL Certificate Information:\n";
    echo "Issuer: " . $sslInfo['issuer']['CN'] . "\n";
    echo "Valid From: " . date("Y-m-d H:i:s", $sslInfo['validFrom_time_t']) . "\n";
    echo "Valid To: " . date("Y-m-d H:i:s", $sslInfo['validTo_time_t']) . "\n";
} else {
    echo "Could not retrieve SSL certificate information.\n";
}

?>
