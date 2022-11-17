<?php

session_start(); 
ob_start(); 

$url = "https://au-api.basiq.io/token";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "basiq-version: 3.0",
   "Content-Type: application/x-www-form-urlencoded",
   "Authorization: Basic NzM4NDE4YjktNDdlYy00OGI2LTg5ODEtNjg0OGI3NzU2ZDczOjU1YWU5YjhiLTEzNDEtNDQxYi04M2IxLTg5ZGQ1MDYyYWNhNw==",
   "Content-Length: 0",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$server_token = curl_exec($curl);
curl_close($curl);

$server_obj = json_decode( $server_token );

// //Print the array in a simple JSON format
// echo '<pre>';
// echo json_encode($server_token, JSON_PRETTY_PRINT);
// echo '</pre>';


// Calling user EP to generate a user using token. 

$urls = "https://au-api.basiq.io/connectors";

$curls = curl_init($urls);
curl_setopt($curls, CURLOPT_URL, $urls);
curl_setopt($curls, CURLOPT_POST, true);
curl_setopt($curls, CURLOPT_RETURNTRANSFER, true);

$headerss = array(
   "Authorization: Bearer $server_obj->access_token",
   "Content-Type: application/json",
);
curl_setopt($curls, CURLOPT_HTTPHEADER, $headerss);

//$datas = '{"email": '.json_encode($email).'}';
// .', "mobile": '.json_encode($mobile)
// var_dump($datas);


//curl_setopt($curls, CURLOPT_POSTFIELDS, $datas);

//for debug only!
curl_setopt($curls, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curls, CURLOPT_SSL_VERIFYPEER, false);

$resps = curl_exec($curls);
curl_close($curls);

$user_object = json_decode( $resps );

var_dump($user_object);
exit();
exit; 


?>
