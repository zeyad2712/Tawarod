<?php 
include "connection.php";
// // $select_client="SELECT `client`.* ROW_NUMBER() as `number_client` FROM `client` WHERE `client_id`=5";
$select_client="SELECT 
    client.*,
    ROW_NUMBER() OVER (ORDER BY client.client_id) AS number_client
FROM 
    client
WHERE 
    client.client_id = 5";
// $run=mysqli_query($connect,$select_client);
// $hana=mysqli_fetch_assoc($run);
// echo $hana['number_client'];
$length = 10;    
echo substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
?>