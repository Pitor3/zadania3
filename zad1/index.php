<?php
//$url = 'localhost/test2/zad1/api/';
$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . 'api/';

$response = parser(['method' => 'generate']);
echo 'generate; seed:' . $response['data']['seed'] . ', number:' . $response['data']['number'] . '<br><br>';

$response = parser(['method' => 'generate']);
echo 'generate; seed:' . $response['data']['seed'] . ', number:' . $response['data']['number'] . '<br><br>';

$response = parser(['method' => 'retrive', 'seed' => 23]);
echo 'retrive 23; seed:' . $response['data']['seed'] . ', number:' . $response['data']['number'] . '<br><br>';

$response = parser(['method' => 'generate']);
echo 'generate; seed:' . $response['data']['seed'] . ', number:' . $response['data']['number'] . '<br><br>';

$seed = $response['data']['seed'];
$response = parser(['method' => 'retrive', 'seed' => $seed]);
echo 'retrive ' . $seed . '; seed:' . $response['data']['seed'] . ', number:' . $response['data']['number'] . '<br><br>';




function parser($data)
{
    global $url;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);
    if($response){
        $response = json_decode($response, true);
    }

    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return (['code' => $statusCode, 'data' => $response]);
}
