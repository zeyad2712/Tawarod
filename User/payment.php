<?php
// include 'nav.php';
$x=null;

// $rand=isset($_SESSION['promocode'])? $_SESSION['promocode']:NULL;
// if(isset($_SESSION['promocode'])){
    // echo "gannah top w mina cantaloupe";
    // $takhBoom=$_SESSION['randTarek'];

// }

if($x==1){
    header("location:homee.php");
}
include("emailfree.php");
 
if(isset($_GET['pay'])){
$request_id=$_GET['pay'];

// $select="SELECT * FROM `client` JOIN `project` ON `client`.`project_id` = `project`.`project_id`
// JOIN `request` ON `project`.`project_id` = `request`.`project_id` 
// JOIN `freelancer` ON `request`.`freelancer_id` = `request`.`freelancer_id` 
// where `request`.`request_id`=$request_id";
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
$client_id=$fetch['client_id'];
$promocode=$fetch['promocode'];
$project_name=$fetch['project_name'];
$job_title=$fetch['job_title'];
$hours=$fetch['hours_requested'];
$price=$fetch['price/hour'];
$project_id=$fetch['project_id'];
$freelancer_id=$fetch['freelancer_id'];
$total=$price * $hours;
$x=true;
// echo $freelancer_name;
// echo $project_name;
// echo $job_title;
// echo $hours;
// echo $price;
// echo "<br>".$total."<br>".$freelancer_id ,$client_id ,$request_id;
if(isset($_POST['offer']))
{
    $promocode_pay=$_POST['promocode'];
    if(!empty($promocode_pay)){
        // echo $promocode."1111<br>";echo$rand."<br>";
        if($promocode==$promocode_pay){
            $total*=0.05;
            $update_promocode="UPDATE `client` SET `promocode`=NULL where `client_id`=$client_id";
$run_update_promocode=mysqli_query($connect,$update_promocode);
$x=FALSE;
            // unset($_SESSION['promocode']);
        }else{
            $error ="incorrect promocode";
        }
    }else{
$error="please, put the promocode ";
    }
}
if(isset($_POST['payment'])){
    //  $request_id=$_POST['id'];
    if(!empty($_POST['card-num']) && !empty($_POST['name']) && !empty($_POST['exp'])&& !empty($_POST['cvv'])){

        $insert=" INSERT INTO `project_members` VALUES ($project_id,$freelancer_id)";
        $run_insert=mysqli_query($connect,$insert);


        // law fe error de a5er 7aga zawdnaha



        $insert_task="INSERT INTO `task_details` VALUES ($project_id,$freelancer_id,1,NULL)";
        $run_insert_task=mysqli_query($connect,$insert_task);
 


        
        $insert_payment=" INSERT INTO `payment` VALUES (NULL,$request_id,$client_id,$freelancer_id,$total)";
        $run_payment=mysqli_query($connect,$insert_payment);
        $msg_freelancer="Dear $freelancer_name, <br>
        $client_name Just paid you the full amount of $total in advance for your work on his project $project_name on Tawarod. <br>
        for any further questions don't hesitate to contact $client_email  <br> <br>
        Best Regards, <br>
        $client_name";
        echo $freelancer_name;
        echo $job_title;
        echo $hours;
        
        $x=1;
        $mail->setFrom('marizthabet@gmail.com', 'tawarod');          //sender mail address , website name
        $mail->addAddress($freelancer_email);      //reciever mail address
        $mail->isHTML(true);                               
        $mail->Subject = 'payment';             //mail subject
        $mail->Body=($msg_freelancer);                  //mail content
        $mail->send(); 
        $msg_client="Dear $client_name, <br>
        you just  paid  the full amount of $total in advance for your work on his project $project_name on Tawarod. <br>
         to $freelancer_name for any further questions don't hesitate to contact  $freelancer_email  <br> <br>
        Best Regards, <br>
        tawarod";
        
        $mail->setFrom('marizthabet@gmail.com', 'tawarod');          //sender mail address , website name
        $mail->addAddress($freelancer_email);      //reciever mail address
        $mail->isHTML(true);                               
        $mail->Subject = 'payment';             //mail subject
        $mail->Body=($msg_client);                  //mail content
        $mail->send(); 
        header("location:homee.php");
    }else{
        $error="please,put the required data";
    }
    
    } }
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/payment.css">
    <title>Payment</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-sm-12">
                <div class="pic">
                    <img src="./images/Payment Information-bro.png" height="500px" width="500px" alt="">
                </div>
                <div class="card ">
                    <div class="freelancer-details">
                        <!-- -----------------------------------freelancer data-------------------------- -->
                        <p class="heading">FREELANCER DATA</p> 
                        <p class="text-warning mb-0">Freelancer Name:</p>
                        <p><?php echo $freelancer_name ?></p> <!-- echo here in <p></p>-->
                        <p class="text-warning mb-0">Job Title:</p>
                        <p><?php echo $job_title ?></p> <!-- echo here in <p></p>-->
                        <p class="text-warning mb-0">Hours:</p>
                        <p><?php echo $hours ?></p> <!-- echo here in <p></p>-->
                        <p class="text-warning mb-0">Total Price:</p>
                        <p><?php echo $total ?></p> <!-- echo here in <p></p>-->
                    </div>
                    <p class="heading">PAYMENT DETAILS</p>
                    <form class="card-details " action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $key['request_id']?>">
                        <div class="form-group mb-0">
                            <p class="text-warning mb-0">Card Number</p>
                            <input type="text" name="card-num" placeholder="1234 5678 9012 3457" size="17" id="cno"
                                minlength="19" maxlength="19">
                           
                        </div>

                        <div class="form-group">
                            <p class="text-warning mb-0">Cardholder's Name</p> <input type="text" name="name"
                                placeholder="Name" size="17">
                        </div>
                        <div class="form-group pt-2">
                            <div class="row d-flex">
                                <div class="col-sm-4">
                                    <p class="text-warning mb-0">Expiration</p>
                                    <input type="text" name="exp" placeholder="MM/YYYY" size="7" id="exp" minlength="7"
                                        maxlength="7">
                                </div>
                                <div class="col-sm-3">
                                    <p class="text-warning mb-0">Cvv</p>
                                    <input type="password" name="cvv" placeholder="&#9679;&#9679;&#9679;" size="1"
                                        minlength="3" maxlength="3">
                                </div>
                        <?php if($promocode && $x){ ?>
                        <div class="form-group">
                            <p class="text-warning mb-0">Promocode</p> <input type="text" name="promocode"
                                placeholder="Promocode" size="17"> <button class="btn btn-primary" type="submit" name="offer">done</button>
                        </div>
                        <?php } ?>
                       
                                <div class=" div col-sm-5 pt-0">
                                    <button type="submit" name="payment" class="btn btn-primary"><i
                                            class="fas fa-arrow-right px-3 py-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>


   
</body>

</html>