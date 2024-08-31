<?php
// include("request_detailsclient.php");

// // $request_id=28;
// if(isset($_GET['request'])){
// $request_id=$_GET['request'];
$select="SELECT * FROM `freelancer` 
JOIN `request` ON `freelancer`.`freelancer_id` = `request`.`freelancer_id`
JOIN `project` ON `project`.`project_id` = `request`.`project_id`
JOIN `client` ON `client`.`client_id` = `project`.`client_id`
WHERE `request`.`request_id`=$request_id";
 $run=mysqli_query($connect,$select);
$fetch=mysqli_fetch_assoc($run);
$freelancer_name=$fetch['freelancer_name'];
$freelancer_email=$fetch['freelancer_email'];
$client_email=$fetch['client_email'];
$client_name=$fetch['client_name'];
$project_name=$fetch['project_name'];
$hours=$fetch['hours_requested'];
$price=$fetch['price/hour'];
$total=$price * $hours;
$msg="Dear $freelancer_name, <br>
$client_name Just requested you  to work in $project_name <br>
the full amount of $total in advance for your work on his project $project_name on Tawarod. <br>
for any further questions don't hesitate to contact $client_email  <br> <br>
Best Regards, <br>
Tawarod";
// echo $freelancer_name;
// echo $project_name;
// echo $hours;


$mail->setFrom('marizthabet@gmail.com', 'tawarod');          //sender mail address , website name
$mail->addAddress($freelancer_email);      //reciever mail address
$mail->isHTML(true);                               
$mail->Subject = 'New request';             //mail subject
$mail->Body=($msg);                  //mail content
$mail->send(); 

