<?php
include 'nav.php';
$freelancer_id=$_SESSION['freelancer_id'];
$error_update = "";
$select = "SELECT freelancer.* , rate.freelancer_id, AVG(rate.rate) AS avg_rate, category.* ,rank.*,sub_category.*
FROM freelancer 
LEFT JOIN rate ON rate.freelancer_id = freelancer.freelancer_id
LEFT JOIN category ON freelancer.cat_id = category.cat_id
LEFT JOIN rank ON freelancer.rank_id = rank.rank_id 
LEFT JOIN sub_category ON category.cat_id = sub_category.cat_id
WHERE freelancer.freelancer_id = $freelancer_id";
$run_select = mysqli_query($connect, $select);
$fetch = mysqli_fetch_assoc($run_select);

$name = $fetch['freelancer_name'];
$img = $fetch['freelancer_image'];
$about = $fetch['about'];
$email = $fetch['freelancer_email'];
$hours = $fetch['available_hours'];
$job = $fetch['job_title'];
$price_per_hour = $fetch['price/hour'];
$avg_hour = $fetch['average_rate'];
$category = $fetch['cat_name'];
$rank_name = $fetch['rank_name'];
$views =$fetch['views'];
$cat_id=$fetch['cat_id'];
$subCat=$fetch['subcat_id'];
$rank_id=$fetch['rank_id'];
$hide=$fetch['hide'];
$rate = isset($fetch['avg_rate']) ? round($fetch['avg_rate'] / 2, 1) : 'No rating yet';


$bsbs=FALSE;
$select5 = "SELECT * FROM freelancer JOIN category ON category.cat_id = freelancer.cat_id WHERE freelancer.freelancer_id = $freelancer_id AND `freelancer`.`cat_id` IS NOT NULL";
$run_select5=mysqli_query($connect , $select5);
$fetch1= mysqli_fetch_assoc($run_select5);
$cou= mysqli_num_rows ($run_select5);

if($cou >0){        
    $cat=$fetch1['cat_name'];
    $bsbs=TRUE;
}

$select_link = "SELECT * FROM `link` WHERE `freelancer_id` = $freelancer_id";
$run_select = mysqli_query($connect, $select_link);
$number = mysqli_num_rows($run_select);

$select_sample = "SELECT * FROM `sample` WHERE `freelancer_id` = $freelancer_id";
$run_sample = mysqli_query($connect, $select_sample);
$number_sample = mysqli_num_rows($run_sample);


$select_request = "SELECT * FROM `request` 
                   JOIN `project` ON `project`.`project_id` = `request`.`project_id` 
                   JOIN `client` ON `client`.`client_id` = `project`.`client_id` 
                   WHERE `request`.`freelancer_id` = '$freelancer_id' AND `request_status` = 'pending'";
$run_request = mysqli_query($connect, $select_request);
$num_request = mysqli_num_rows($run_request);


$select_comment = "SELECT * FROM `review`
                   JOIN `client` ON `client`.`client_id` = `review`.`client_id`
                   WHERE `review`.`freelancer_id` = $freelancer_id";
$run_comment = mysqli_query($connect, $select_comment);
$num_comment = mysqli_num_rows($run_comment);

if (isset($_POST['edit'])) {
    $new_hour = $_POST['hour'];
    if (!empty($new_hour)) {
        $update = "UPDATE `freelancer` SET `available_hours` = $new_hour WHERE `freelancer_id` = $freelancer_id";
        $run_update = mysqli_query($connect, $update);
        $error_update = "Available hours updated successfully";
        header("refresh:2; url=freelancerprofile mena.php");
    } else {
        $error_update = "Please put the new available hours";
    }
}

if (isset($_GET['delete_s'])) {
    $sampleid = $_GET['delete_s'];
    $select_samp = "SELECT * FROM `sample` WHERE `sample_id` = $sampleid";
    $run_samp = mysqli_query($connect, $select_samp);
    $fetch_sample = mysqli_fetch_assoc($run_samp);
    $file = $fetch_sample['sample_file'];

    $delete = "DELETE FROM `sample` WHERE `sample_id` = $sampleid";
    $run_delete = mysqli_query($connect, $delete);
    unlink("./image/" . $file);

    header("location:freelancerprofile mena.php");
}

if (isset($_GET['delete_l'])) {
    $linkid = $_GET['delete_l'];
    $deletel = "DELETE FROM `link` WHERE `link_id` = $linkid";
    $run_delete = mysqli_query($connect, $deletel);
    header("location:freelancerprofile mena.php");
}
$approval="SELECT * FROM request 
                   JOIN project ON project.project_id = request.project_id 
                   JOIN client ON client.client_id = project.client_id 
                   WHERE request.freelancer_id = '$freelancer_id' AND request_status = 'approval'";
$run_app = mysqli_query($connect, $approval);
$num_approval = mysqli_num_rows($run_request);
$cancel="SELECT * FROM request 
                   JOIN project ON project.project_id = request.project_id 
                   JOIN client ON client.client_id = project.client_id 
                   WHERE request.freelancer_id = '$freelancer_id' AND request_status = 'Decline'";
$run_can = mysqli_query($connect, $cancel);
$num_cancel = mysqli_num_rows($run_can);

$i=0;
// $cat_id=4;
$sub=array(11,12,13,14,15);
$ran=array(2,3,1);
$web=array(7,16,32.5,9,20,35,15,27.5,47.5,11.5,20,37.5,8,16,32.5);
// echo $rank_id ,$subCat,$cat_id;
for($x=0;$x<5;$x++){
    
    for($y=0 ;$y<3;$y++){
        if($cat_id==4 && $subCat==$sub[$x] && $rank_id==$ran[$y]){
            
            $price=$web[$i];
        }
        $i++;   
    }
}
$i=0;
// $cat_id=5;
$sub=array(17,16);
$ran=array(2,3,1);
$web=array(18.5,27.5,65,8,20,40);
// echo $rank_id ,$subCat,$cat_id;
for($x=0;$x<2;$x++){
    
    for($y=0 ;$y<3;$y++){
        if($cat_id==5 && $subCat==$sub[$x] && $rank_id==$ran[$y]){
            
            $price=$web[$i];
        }
        $i++;   
    }
}
$i=0;
// $cat_id=8;
$sub=array(18,19);
$ran=array(2,3,1);
$web=array(12,15,27.5,15,27.5,50);
// echo $rank_id ,$subCat,$cat_id;
for($x=0;$x<2;$x++){
    
    for($y=0 ;$y<3;$y++){
        if($cat_id==8 && $subCat==$sub[$x] && $rank_id==$ran[$y]){
            
            $price=$web[$i];
        }
        $i++;   
    }
}


$i=0;
// $cat_id=6;
// $sub=array(18,19);
$ran=array(2,3,1);
$web=array(10.5,25,57.5);
// echo $rank_id ,$subCat,$cat_id;

    
    for($y=0 ;$y<3;$y++){
        if($cat_id==6 && $rank_id==$ran[$y]){
            
            $price=$web[$i];
        }
        $i++;   
    }
    $i=0;
    // $cat_id=9;
    // $sub=array(18,19);
    $ran=array(2,3,1);
    $web=array(10.5,20,37.5);
    // echo $rank_id ,$subCat,$cat_id;
    
        
        for($y=0 ;$y<3;$y++){
            if($cat_id==9 && $rank_id==$ran[$y]){
                
                $price=$web[$i];
            }
            $i++;   
        }
        $i=0;
        // $cat_id=7;
        // $sub=array(18,19);
        $ran=array(2,3,1);
        $web=array(15,27.5,50);
        // echo $rank_id ,$subCat,$cat_id;
        
            
            for($y=0 ;$y<3;$y++){
                if($cat_id==7 && $rank_id==$ran[$y]){
                    
                    $price=$web[$i];
                }
                $i++;   
            }



            // links section---------------
            
if (isset($_POST['submit'])) {
    $link = $_POST['link'];
$x=TRUE;
$ext=substr($link,8,5);
if($ext=="www.l" ||$ext== "m.fac" ||$ext=="githu"){
$select_r="SELECT * FROM `link` WHERE `freelancer_id`=$freelancer_id";
$run_r=mysqli_query($connect,$select_r);
foreach($run_r as $data){
    $linkr=$data['link'];
    $type=substr($linkr,8,5);
    if($ext==$type ){
        $x=FALSE;
    }
    elseif($ext== $type ){
        $x=FALSE;
    } elseif($ext==$type ){
        $x=FALSE;
    }
} if($x){

    $insert_link = "INSERT INTO `link`  VALUES ( NULL ,'$freelancer_id', '$link')";
    $run_insert = mysqli_query($connect, $insert_link);
    
    
        $error= "Link added successfully.";
        header("refresh:1 ; url=freelancerprofile mena.php");
}else{
    $error="you put this type before "; 
}
 
}else{
    $error="please,put the link from facebook or githup or linkedin";
}
}
$select_links = "SELECT * FROM `link` WHERE `freelancer_id` = '$freelancer_id'";
$run_select = mysqli_query($connect, $select_links);
$number=mysqli_num_rows($run_select);
if(isset($_POST['hide'])){
    $update_hide="UPDATE `freelancer` SET `hide`=0 WHERE `freelancer_id`=$freelancer_id";
    $run_update=mysqli_query($connect , $update_hide);
    header("location:freelancerprofile mena.php");

}
if(isset($_POST['unhide'])){
    $update_unhide="UPDATE `freelancer` SET `hide`=1 WHERE `freelancer_id`=$freelancer_id";
    $run_update=mysqli_query($connect , $update_unhide);
    header("location:freelancerprofile mena.php");
    

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>



    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">








    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link rel="stylesheet" href="./css/freelancerprofile.css">


</head>

<body>






<nav class="sidebar" id="ssideBarr">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="./images/logo.png" alt="">
            </span>
            <div class="text logo-text">
                <span class="name">Notifications</span><br>
                <span class="name">New Requests</span>
            </div>
        </div>
        <i class='fa-solid fa-bell ' style="font-size: 15px; color: white;" onclick="openSide()"></i>
    </header>

    <div class="menu-bar">
        <div class="menu">
            <ul class="menu-req">
                <?php if ($num_request > 0) { ?>
                    <?php foreach ($run_request as $data) { ?>
                        <li class="nav-link">
                            <div class="req-card">
                                <div class="req-info">
                                    <h3><?php echo $data['client_name']; ?></h3>
                                    <p>requested you in the project named</p>
                                    <h3><?php echo $data['project_name']; ?></h3>
                                </div>
                                <div class="req-btn">
                                    <a class="req-a" href="request_detailsfreelancer.php?request_id=<?php echo $data['request_id']; ?>">View Details</a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <div class="text logo-text1">
                        <span class="name">No requests yet</span>
                    </div>
                <?php } ?>

                <div class="text logo-text">
                    <span class="name1">My Approved Projects</span>
                </div>

                <?php if ($num_approval > 0) { ?>
                    <?php foreach($run_app as $app) { ?>
                        <li class="nav-link">
                            <div class="req-card1">
                                <div class="req-info">
                                    <h3><?php echo $app['client_name']; ?></h3>
                                    <p>added you in the project named</p>
                                    <h3><?php echo $app['project_name']; ?></h3>
                                </div>
                            </div>
                            <div class="req-card1">
                                <div class="req-info">
                                    <h3><?php echo $app['client_name']; ?></h3>
                                    <p>added you in the project named</p>
                                    <h3><?php echo $app['project_name']; ?></h3>
                                </div>
                            </div>
                            <div class="req-card1">
                                <div class="req-info">
                                    <h3><?php echo $app['client_name']; ?></h3>
                                    <p>added you in the project named</p>
                                    <h3><?php echo $app['project_name']; ?></h3>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <div class="text logo-text1">
                        <span class="name">No approvals yet</span>
                    </div>
                <?php } ?>

                <div class="text logo-text">
                    <span class="name1">Rejected Projects</span>
                </div>

                <?php if ($num_cancel > 0) { ?>
                    <?php foreach($run_can as $can) { ?>
                        <li class="nav-link">
                            <div class="req-card1">
                                <div class="req-info">
                                    <p>You rejected the project</p>
                                    <h3><?php echo $can['project_name']; ?></h3>
                                    <p>from</p>
                                    <h3><?php echo $can['client_name']; ?></h3>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <div class="text logo-text1">
                        <span class="name">No rejections yet</span>
                    </div>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>






    <div class="home">
        <div class="main">
            <div class="main-first">
                <div class="info">
                    <div class="img">
                        <img src="<?php echo "./images/" . $img ?>" alt="">
                    </div>
                    <h3><?php echo $name; ?></h3>
                    <h5><?php  if($bsbs){ echo $cat ;}?></h5>
                    <!-- <div class="rev-icon">
                        <span>
                            <a href="#">
                                <i class="fa-solid fa-star" style="color: black;"></i> <?php echo $rate; ?>
                            </a>
                        </span>
                    </div> -->
                </div>

                <div class="links">
                    <h1> Links</h1> 
                     
                    <?php if ($number > 0) {
                        foreach ($run_select as $data) { ?>
                               <a href="<?php echo $data['link']; ?>">   
                                  <?php echo $data['link']; ?>
                            </a>
                        <?php }
                    } else { ?>
                        <p>No links uploaded yet</p>
                    <?php }?>
                    <?php if ($number < 3) {?>
                   <button class="plus-ico"  onclick="openPopup100()"><i class="fa-solid fa-plus" style="color: #c18d52;"></i></button> 
                   <?php } ?>
                </div>

                <div class="links">
                    <a href="freelancerreview.php">
                        <h1>Reviews</h1>
                    </a>
                </div>
           
            <div class="links">
            
                  
                <h1 class="v">Visibilty</h1>
                
                    <form method="POST">
                        <?php if($hide==0){?>
                            
                   
                                <button class="invis" name="unhide" type="submit">Invisible</button>
                                <?php }else{ ?>
                                    
                                    <button class="vis" name="hide" type="submit">Visible</button>
                        <?php } ?>
                    
                </div>
            </div>
                </form>



            <div class="main-sec">
                <div class="information">
                    <p>Full Name: <?php echo $name; ?></p>
                    <p>Email: <?php echo $email; ?></p>
                    <p>Portal : <?php if(isset($price)){ echo $price;} ?> $/H </p>
                    <p>FreeLancer : <?php echo $price_per_hour ?>$/H </p>
                <p>Rank: <?php echo $rank_name ?></p>
                <p>job title:<?php echo $job ?>  </p>
                <p>about:<?php echo $about ?>  </p>
                <p>Views:<?php echo $views ?> </p>

                    <p>Available Hours: <?php echo $hours; ?> /H <span>
                        
                    <button class="clock" onclick="openPopup()">
                        <i class="fa-solid fa-clock" style="font-size:15px; margin-left:10px;"></i>
                    </button>
                </span> </p>
                    <a class="update" href="fl_edit_profile.php?edit=<?php echo $freelancer_id ?>">
                        <i class="fa-regular fa-pen-to-square"></i> Edit
                        <a href="changepass_freelancer.php" class="add2">change password   <span class="addi"><i class="fa-solid fa-plus fa-pen"></i></span></a>

                    </a>
                </div>

                <div class="upload">
                <a href="my project_f.php" class="add">My project <span><i class="fa-solid fa-plus fa-bounce"></i></span></a><br>

                    <a href="add_sample.php" class="add">ADD SAMPLE <span><i class="fa-solid fa-plus fa-bounce"></i></span></a>
                    <div class="main-sample">
                        <?php if ($number_sample > 0) {
                            foreach ($run_sample as $run) { ?>
                                <div class="sample">
                                    <div class="info">
                                        <h3><?php echo $run['sample_name']; ?></h3>
                                        <p><?php echo $run['sample_desc']; ?></p>
                                    </div>
                                    <div class="big-btns">
                                        <div class="mini-btns">
                                            <a href="edit_sample.php?edit=<?php echo $run['sample_id']?>">Edit <i class="fa-regular fa-pen-to-square" style="color: blue;"></i></a>
                                            <a href="freelancerprofile mena.php?delete_s=<?php echo $run['sample_id']; ?>">Delete <i class="fa-solid fa-trash" style="color: red;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } else { ?>
                            <p>No samples uploaded yet</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="reviews">
        <h1>Reviews</h1>
        <div class="reviews-content">
            <?php if ($num_comment > 0) {
                foreach ($run_comment as $data) { ?>
                    <div class="card">


                        <div class="head-card">
                            <div class="img">
                                <img src="../images/user1.png" alt="">
                            </div>
                            <div class="name">
                                <h3><?php echo $data['client_name']; ?></h3>
                                <span class="rate">
                                    <i class="fa-solid fa-star" style="color: black;"></i> 5
                                </span>
                            </div>
                        </div>
                        <p><?php echo $data['text']; ?></p>
                    </div>
                <?php }
            } else { ?>
                <p>No reviews yet</p>
            <?php } ?>
        </div>
    </div> -->


    <div class="main-form d-none" id="popup">
        <div class="popup">
            <a href="">
                <i class="icon fa-solid fa-xmark" onclick="closePopup()"></i>
                <form method="post">
            </a>
            <h1>Edit Hours</h1>
            <input name="hour" type="hours" placeholder="Hours">
            <button class="edit"  name="edit"  onclick="closePopup()">Edit</button>
            </form>
        </div>
    </div>



<!-- <div class="main-formm d-none" id="popupp">
        <div class="popupp">
            <a href="">
                <i class="fa-solid fa-plus" onclick="closePopupp()"></i>
                <form method="post">
            </a>
            <h1>ADD LINKS</h1>
            <input name="hour" type="hours" placeholder="LINKS">
            <button class="add"  name="edit"  onclick="closePopupp()">ADD</button>
            </form>
        </div>
    </div> -->

<?php if(!isset($_POST['submit'])){?>

<div class="container-popup d-none" id="popup100">

    <div class="main-popup">
        
        <div class="headingg">
            <a href="#">
                <i class="fa-solid fa-x" onclick="closePopup100()"></i>
            </a>
            <h1>
                Add Your links
            </h1>
            
        </div>

        <form method="post">

            <label>
                Link:
            </label>
            <input type="text" name="link" placeholder="Enter Link">

            <button type="submit" name="submit">ADD</button>


        </form>
    </div>
</div>

<?php } else {?>
<div class="container-popup " id="popup100">

    <div class="main-popup">
        
        <div class="headingg">
            <a href="#">
                <i class="fa-solid fa-x" onclick="closePopup100()"></i>
            </a>
            <h1>
                <?php echo $error ?>
            </h1>
            
        </div>

        <form method="post">

            <label>
                Link:
            </label>
            <input type="text" name="link" placeholder="Enter Link">

            <button type="submit" name="submit">ADD</button>


        </form>
    </div>
</div>

<?php } ?>
    <script>
        var popup = document.getElementById("popup")

        function openPopup() {
            popup.classList.remove("d-none")
        }
        function closePopup() {
            popup.classList.add("d-none")
        }



        
         
                var popup100 = document.getElementById("popup100")

function openPopup100(){
    popup100.classList.remove("d-none")
}
function closePopup100(){
    popup100.classList.add("d-none")
}
    </script>

<script>

    var sidebar = document.getElementById("ssideBarrr")

    function openSide(){
        sidebar.classList.toggle("close");
    }
   
</script>



</body>
</html>
