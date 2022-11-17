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

/////


$url1 = "https://au-api.basiq.io/connectors";

$curl1 = curl_init($url1);
curl_setopt($curl1, CURLOPT_URL, $url1);
curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);

$headers1 = array(
   "Authorization: Bearer $server_obj->access_token",
   "Accept: application/json",
);
curl_setopt($curl1, CURLOPT_HTTPHEADER, $headers1);
//for debug only!
curl_setopt($curl1, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl1, CURLOPT_SSL_VERIFYPEER, false);

$resp1 = curl_exec($curl1);
curl_close($curl1);

$myObject = json_decode($resp1, true);
$c_data = $myObject["data"];


////

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title> Connectors </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css" rel="stylesheet">

<script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.19.1/dist/extensions/mobile/bootstrap-table-mobile.min.js"></script>


</head>
<body>



<div class="container"> 
 
 <table
  id="myTable"
  data-show-columns="true"
  data-search="true"
  data-mobile-responsive="true"
  data-check-on-init="true"> 
 
    <thead>
      <tr>
      	<th> Logos </th>
        <th> Connector id </th>
        <th> Connector Name </th> 
        <th> Connector Method </th>                
      </tr>
    </thead>
    <tbody>
      <?php foreach($c_data as $key => $item): ?>
      	<tr>  
      	  <td> <img src="<?php echo $item["logo"]["links"]["square"]; ?>" style="width:50px;" ></td>    
    	  <td><?PHP echo $item["id"]; ?></td>
    	  <td><?PHP echo $item["institution"]["name"]; ?></td>
    	  <td><?PHP echo $item["method"]; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>  </table>
</div>


<script>

  $(function() {
    $('#myTable').bootstrapTable()
  })

</script>

</body>
</html>



<!---->
