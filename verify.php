<?php
$proxy = 'http://fixie:Flxod6VSpeItsgI@velodrome.usefixie.com:80';
$proxyauth = 'qostttbb@gmail.com:noqnoq123';
$access_token = 'bjMobsS6ndui8SI7L3yfrJTH/J70rI8N/UdD2xX6vKOJQgbooymVfPIiDMOer8HbfO4rhEtXypseVhC9nY4HoRIUnZQ3j0CGVFwLc8Pq/a4lddesAE/PjK06ihIXeq+rw/gWf+5jD/Lf8ToVJPvNuwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

?>
