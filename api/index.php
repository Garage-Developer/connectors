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


$curly = curl_init();

curl_setopt_array($curly, array(
  CURLOPT_URL => 'https://au-api.basiq.io/connectors',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer $server_obj->access_token',
    'Accept: application/json'
  ),
));

$responsy = curl_exec($curly);

curl_close($curly);
echo $responsy;
exit ();
exit;


?>
