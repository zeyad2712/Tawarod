


<?php
include("nav.php");
$client_id=isset($_SESSION['client_id'])?$_SESSION['client_id']:NULL;
$freelancer_id=isset($_SESSION['freelancer_id'])?$_SESSION['freelancer_id']:NULL;
$error="";
if(isset($_GET['id'])){
    $project_id=$_GET['id'];
    $select_project="SELECT * FROM `project` JOIN `type` ON `type`.`type_id`= `project`.`type_id`
    JOIN `client` ON `client`.`client_id`=`project`.`client_id`
     WHERE `project`.`project_id`=$project_id";
    $run_project=mysqli_query($connect,$select_project);
    $fetch=mysqli_fetch_assoc ($run_project);
    $project_name=$fetch['project_name'];
    $project_desc=$fetch['project_desc'];
    $type=$fetch['type_name'];
    $type_id=$fetch['type_id'];
    $client_name=$fetch['client_name'];
    $clientid=$fetch['client_id'];
    $client_email=$fetch['client_email'];
    $client_img=$fetch['client_image'];
    $select_member="SELECT * FROM `project_members` JOIN `freelancer` ON `freelancer`.`freelancer_id`=`project_members`.`freelancer_id`  
    
     WHERE `project_members`.`project_id` =$project_id";
    $run_member=mysqli_query($connect,$select_member);
    $number_member=mysqli_num_rows($run_member);
    // foreach($run_member as $data){
    //     $data['freelancer_name'];
    //     $data['freelancer_id'];
    // }
    $select_task_1="SELECT * FROM `task_details` JOIN `project` ON  `project`.`project_id`=`task_details`.`project_id`
     JOIN `status` ON `status`.`status_id`=`task_details`.`status_id`
     JOIN `freelancer` ON `freelancer`.`freelancer_id`=`task_details`.`freelancer_id` 
     JOIN  `category` ON `category`.`cat_id`=`freelancer`.`cat_id`
    WHERE `task_details`.`project_id`=$project_id AND `task_details`.`status_id`=1";
    $run_task_1=mysqli_query($connect,$select_task_1);
    $number_1=mysqli_num_rows($run_task_1);
    $select_task_2="SELECT * FROM `task_details` JOIN `project` ON  `project`.`project_id`=`task_details`.`project_id`
    JOIN `status` ON `status`.`status_id`=`task_details`.`status_id`
    JOIN `freelancer` ON `freelancer`.`freelancer_id`=`task_details`.`freelancer_id` 
    JOIN  `category` ON `freelancer`.`cat_id`=`category`.`cat_id`
   WHERE `task_details`.`project_id`=$project_id AND `task_details`.`status_id`=2";
   $run_task_2=mysqli_query($connect,$select_task_2);
   $number_2=mysqli_num_rows($run_task_2);

   $select_task_3="SELECT * FROM `task_details` JOIN `project` ON  `project`.`project_id`=`task_details`.`project_id`
   JOIN `status` ON `status`.`status_id`=`task_details`.`status_id`
   JOIN `freelancer` ON `freelancer`.`freelancer_id`=`task_details`.`freelancer_id` 
   JOIN  `category` ON `freelancer`.`cat_id`=`category`.`cat_id`
  WHERE `task_details`.`project_id`=$project_id AND `task_details`.`status_id`=3";
  $run_task_3=mysqli_query($connect,$select_task_3);
  $number_3=mysqli_num_rows($run_task_3);

if(isset($_POST['progress'])){
    $id=$_POST['id'];
    $update="UPDATE `task_details` SET `status_id`=2 where `project_id`=$project_id AND `freelancer_id`=$id";
    $run_update=mysqli_query($connect,$update);
$select_name="SELECT * FROM `freelancer` where `freelancer_id`=$id";
$run_name=mysqli_query($connect,$select_name);
$fetch_name=mysqli_fetch_assoc($run_name);
$freelancer_name=$fetch_name['freelancer_name'];
    $msg="Dear $client_name,<br>

I wanted to provide you with an update on the recent improvements made to your project that name is $project_name  by  $freelancer_name.<br>                                                                                                                                                         If you have any questions or would like to review the changes in detail,get touch with your freelancer                                                                                                   
Best Regards, <br>
Tawarod";

    
    $mail->setFrom('maloka.elhalawany@gmail.com', 'tawarod');          //sender mail address , website name
    $mail->addAddress($client_email);      //reciever mail address
    $mail->isHTML(true);                               
    $mail->Subject = 'task is in progress';             //mail subject
    $mail->Body=($msg);                  //mail content
    $mail->send(); 
    header("location:task-details.php?id=$project_id");



}
if(isset($_POST['done'])){
    $id=$_POST['id'];
    $file=$_FILES['file']['name'];
    
    // var_dump($id);
    if(!empty($file)){
        $updateee="UPDATE `task_details` SET `status_id`=3 , `file`='$file' where `project_id`=$project_id AND `freelancer_id`=$freelancer_id";
        $run_update=mysqli_query($connect,$updateee);
        move_uploaded_file($_FILES['file']['tmp_name'],"./images/".$file);

        $select_name="SELECT * FROM `freelancer` where `freelancer_id`=$freelancer_id";
        $run_name=mysqli_query($connect,$select_name);
        $fetch_name=mysqli_fetch_assoc($run_name);
        $freelancer_name=$fetch_name['freelancer_name'];
            $msg="Dear $client_name,<br>
        
        I wanted to provide you with an update on the recent improvements made to your project that name is $project_name  by  $freelancer_name.<br>                                                                                                                                                         If you have any questions or would like to review the changes in detail,get touch with your freelancer                                                                                                   
        Best Regards, <br>
        Tawarod";
        
            
        $mail->setFrom('maloka.elhalawany@gmail.com', 'tawarod');          //sender mail address , website name
        $mail->addAddress($client_email);      //reciever mail address
        $mail->isHTML(true);                               
        $mail->Subject = 'task is done';             //mail subject
        $mail->Body=($msg);                  //mail content
        $mail->send(); 
    
    
        header("location:task-details.php?id=$project_id");


    }else{
        $error="please,put the file";
    }
}
}
?>










<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/task-details.css">
    <!-- link google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lancelot&display=swap" rel="stylesheet">

    <!-- link font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
<div class="containerrr">
    <aside class="sidebar">
    <div class="workspace-logo"> Client</div>
        <div class="workspace-logo"><a href="viewclientprofile.php?view=<?php echo $clientid?>"><img src="./images/<?php echo $client_img?>" alt=""> <?php echo $client_name ?></a> </div>
        <div class="workspace-logo"> Details</div>
        <nav class="menu">
            <p><?php echo $project_desc ?></p>
        </nav>
        <div class="workspace-menu">
            <h3 ><?php echo $type ?></h3>
            <h5>Team Members</h5>
            <?php if($number_member>0) { 
                foreach($run_member as $data) { ?>
            <ul>
                <li><a href="./viewprofile.php?view_profile=<?php echo $data['freelancer_id']?>" class="p"><img src="./images/<?php echo $data['freelancer_image']?>" alt="">  <?php echo $data['freelancer_name']?></a></li>
            </ul>
            <?php } } else { ?>
                <p>No members yet</p>
        <?php    }?>
        </div>
        <!-- <div class="user-info">
            <img src="user-avatar.jpg" alt="User Avatar">
            <p>Amanda</p>
            <p>Product Designer</p>
        </div> -->
    </aside>

    <main class="content">
        <header class="header">
            <h1><?php echo $project_name ?></h1>
            
            <?php if(isset($_SESSION['client_id']) && ($number_member==0  || $type_id==1)) { ?>
            <a href="./all-freelancer.php" class="request-btn">Request</a>
        <?php } ?>
        </header>
        
<?php if ($number_member>0){?>
        <div class="tasks">
            <div class="task-column to-do">
                <h2>To Do</h2>
                <?php if($number_1 >0){
                 foreach($run_task_1 as $data){?>
                <div class="task-card">
                    <h3><a href="./viewprofile.php?view_profile=<?php echo $data['freelancer_id']?>"><img src="./images/<?php echo $data['freelancer_image']?>" alt="">  <?php echo $data['freelancer_name']?></a></h3>
                    <p><?php echo $data['cat_name']?></p>
                    <?php if($data['freelancer_id']==$freelancer_id) { ?>
                    <button class="btn" onclick="showPopup(<?php echo $data['freelancer_id']?>)"><i class="fa-solid fa-arrow-right" style="color: #c18d52;"></i></button>
                <?php } ?>
                </div>
                <?php } } else{?>
                    <div class="task-card">
                <p>N0 task yet</p>
                </div>
                <?php } ?>
            </div>

            <div class="task-column in-progress">
                <h2>In Progress</h2>
                <?php if($number_2 >0){
                 foreach($run_task_2 as $data){?>
                <div class="task-card">
                    <h3><a href="./viewprofile.php?view_profile=<?php echo $data['freelancer_id']?>"><img src="./images/<?php echo $data['freelancer_image']?>" alt="">  <?php echo $data['freelancer_name']?></a></h3>
                    <p><?php echo $data['cat_name']?></p>
                    <?php if($data['freelancer_id']==$freelancer_id) { ?>
                        <button class="btn" onclick="showwww(<?php echo $data['freelancer_id']?>)">
    <i class="fa-solid fa-arrow-right" style="color: #c18d52;"></i>
</button>

            
                    <?php } ?>
                </div>
                <?php } } else{?>
                    <div class="task-card">
                <p>N0 task yet</p>
                </div>

                <?php } ?>
            </div>

            <div class="task-column completed">
                <h2>Completed</h2>
                <div class="task-card">
                <?php if($number_3 >0){
                 foreach($run_task_3 as $data){?>
                    <h3><a href="./viewprofile.php?view_profile=<?php echo $data['freelancer_id']?>"><img src="./images/<?php echo $data['freelancer_image']?>" alt="">  <?php echo $data['freelancer_name']?></a></h3>
                    <p><?php echo $data['cat_name']?></p>
                    <p>File Name</p>
                    <?php if($client_id || ($data['freelancer_id']==$freelancer_id)) { ?>
                    <a href="" Download="<?php echo $data ['file'] ?>">Download <i class="fa-solid fa-download" style="color: #c18d52;"></i></a>
                <?php } ?>
                </div>
                <?php } } else{?>
                <p>N0 task yet</p>
                <?php } ?>
            </div>
        </div>
        <?php }else{?>
            <h4 class="error">There Is No Freelancer Yet</h4>
            <?php } ?>
        
    </main>
    
</div>
<div class="container-save d-none" id="unsave">
    <form action="" method="POST">
        <div class="cookiesContent" id="cookiesPopup">

            <button class="close" type="submit" onclick="closePopup1()"><i class="fa-solid fa-xmark" style="color: #c18d52;"></i></button>
            <img src="./images/inprog.jpg" width="200px"  alt="cookies-img" />
            <p>Are You Sure You Want To Change The Task Status From "ToDo" To "In Progress" ? </p>
            <form method="POST">
                <input type="hidden" name="id" id="todo">
                <button class="accept" name="progress" type="submit">Yes</button>
            </form>
        </div>
    </form>
</div>
<?php if(!isset($_POST['done'])){?>
<div class="container-save d-none" id="unsaveee">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="cookiesContent">
            <button class="close" type="button" onclick="closePopup2()">
                <i class="fa-solid fa-xmark" style="color: #c18d52;"></i>
            </button>
            <img src="./images/done.png" alt="cookies-img" />
            <p>Are You Sure You Want To Change The Task Status From "In Progress" To "Done" ?</p>
            <input type="hidden" name="id" id="done">
            <input type="file" class="file" id="up" name="file">
            <label for="up" class="filee">Upload Your Project <i class="fa-solid fa-upload" style="color: #203b37;"></i></label>
            <button class="accept" name="done" type="submit">Yes</button>
        </div>
    </form>
</div>
<?php } else {?>

<div class="container-save" id="unsaveee">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="cookiesContent">
            <button class="close" type="button" onclick="closePopup2()">
                <i class="fa-solid fa-xmark" style="color: #c18d52;"></i>
            </button>
            <img src="./images/done.png" alt="cookies-img" />
            <p><?php echo $error ?></p>
            <input type="hidden" name="id" id="done">
            <input type="file" class="file" id="up" name="file">
            <label for="up" class="filee">Upload Your Project <i class="fa-solid fa-upload" style="color: #203b37;"></i></label>
            <button class="accept" name="done" type="submit">Yes</button>
        </div>
    </form>
</div>
<?php } ?>
<!-- <script >
    var popup1 = document.getElementById("unsave")

function showPopup() {
popup1.classList.remove('d-none');
}
function closePopup1(){
popup1.classList.add("d-none")
}
var popup = document.getElementById("unsavee")

function showPopup1() {
popup.classList.remove('d-none');
}
function closePopup(){
popupclassList.add("d-none")
}
</script>  -->
 






<script>
    const popup1 = document.getElementById("unsave");
const projectIdInput1 = document.getElementById("todo");
const popup2 = document.getElementById("unsaveee");
const done = document.getElementById("done");

function showPopup(todo) {
    popup1.classList.remove('d-none');
    projectIdInput1.value = todo;
}

function closePopup1() {
    popup1.classList.add("d-none");
}

function showwww(done) {
    popup2.classList.remove('d-none');
    done.value = done ;
}

function closePopup2() {
    popup2.classList.add("d-none");
}

</script>
    
</body>

</html>
