<?php
include("connection.php");
$client_id=isset($_SESSION['client_id'])?$_SESSION['client_id']:NULL;
$freelancer_id=isset($_SESSION['freelancer_id'])?$_SESSION['freelancer_id']:NULL;

if($client_id){


$freelancerid=$_SESSION['freelancer'];


$select = "SELECT * FROM `chat` WHERE `freelancer_id`=$freelancerid AND `client_id` =$client_id ";
$run = mysqli_query($connect, $select);
$select_seen = "SELECT * FROM `chat` WHERE `freelancer_id`=$freelancerid AND `client_id` =$client_id AND `seen`=0 AND `from_to`='fc'";
$run_seen = mysqli_query($connect, $select_seen);
$number_seen=mysqli_num_rows($run_seen);
if($number_seen >0){
    // for($i=0;$i<$number_seen;$i++){
        foreach($run_seen as $mina){
            $id=$mina['chat_id'];
            $update_seen="UPDATE `chat` SET `seen`=1 where `chat_id`=$id";
            $run_update=mysqli_query($connect,$update_seen);
        // }
    }
}


foreach ($run as $row) {
    $msg = $row['text'];
    if($row['from_to']=="cf"){
    ?>

    <div id="chatdata1">
        <span><?php echo $msg ?> 
        <?php if($row['seen']==1){?> 
        <i class="fa-solid fa-check"></i>
        <?php } ?>
    </span>
    </div> <?php }else{?>
    <div id="chatdata2">
        <span><?php echo $msg ?> </span>
    </div>

<?php } } 
}elseif($freelancer_id){

$clientid=$_SESSION['client'];


$select = "SELECT * FROM `chat` WHERE `freelancer_id`=$freelancer_id AND `client_id` =$clientid ";
$run = mysqli_query($connect, $select);
$select_seen_f = "SELECT * FROM `chat` WHERE `freelancer_id`=$freelancer_id AND `client_id` =$clientid AND `seen`=0 AND `from_to`='cf'";
$run_seen_f = mysqli_query($connect, $select_seen_f);
$number_seen_f=mysqli_num_rows($run_seen_f);
if($number_seen_f >0){
    // for($i=0;$i<$number_seen;$i++){
        foreach($run_seen_f as $minaaa){
            $id=$minaaa['chat_id'];
            $update_seen_f="UPDATE `chat` SET `seen`=1 where `chat_id`=$id";
            $run_update_f=mysqli_query($connect,$update_seen_f);
        // }
    }
}

foreach ($run as $row) {
    $msg = $row['text'];
    if($row['from_to']=="fc"){
    ?>

    <div id="chatdata1">
        <span><?php echo $msg ?>
        <?php if($row['seen']==1){?> 
        <i class="fa-solid fa-check"></i>
        <?php } ?>
    </span>
    </div> <?php }else{?>
    <div id="chatdata2">
        <span><?php echo $msg ?></span>
    </div>

<?php } } } ?>
