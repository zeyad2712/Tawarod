<?php  
// include "connection.php";
include "nav.php";

// $client_id =isset($_SESSION['client_id'])?$_SESSION['client_id']:NULL ;
// $freelancer_id =isset($_SESSION['freelancer_id'])?$_SESSION['freelancer_id']:NULL ;

if (isset($_SESSION['client_id'])){
    $client_id=$_SESSION['client_id'];
}

if (isset($_SESSION['freelancer_id'])){
    $freelancer_id=$_SESSION['freelancer_id'];
}
$error_update = "";

if(isset($_GET['view_profile'])){

    $freelancerid=$_GET['view_profile'];
    // Fetch freelancer data, including category name and average rating
    if(isset($_SESSION['client_id'])){
        
        $update="UPDATE freelancer SET views = views + 1 WHERE freelancer_id= $freelancerid";
            $runUpdate=mysqli_query($connect, $update);
    } 
    if(isset($_SESSION['freelancer_id'])){
        
        if($_SESSION['freelancer_id']!=$freelancerid){
            $update="UPDATE freelancer SET views = views + 1 WHERE freelancer_id= $freelancerid";
                $runUpdate=mysqli_query($connect, $update);

        }
    } 
    $select = "SELECT freelancer.* , rate.freelancer_id, AVG(rate.rate) AS avg_rate, category.* ,rank.* ,sub_category.*
    FROM freelancer 
    LEFT JOIN rate ON rate.freelancer_id = freelancer.freelancer_id
   LEFT JOIN category ON freelancer.cat_id = category.cat_id
   LEFT JOIN rank ON freelancer.rank_id = rank.rank_id 
   LEFT JOIN sub_category ON category.cat_id = sub_category.cat_id
    WHERE freelancer.freelancer_id = $freelancerid";
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
$rank = $fetch['rank_name'];
$views =$fetch['views'];
$cat_id=$fetch['cat_id'];
$subCat=$fetch['subcat_id'];
$rank_id=$fetch['rank_id'];
// $ratEe = isset($fetch['avg_rate']) ? round($fetch['avg_rate'], 1) : "No ratings yet";
$ratEe= round($fetch['avg_rate'], 1) ;
$ratEe/=2;
$update_rate="UPDATE freelancer SET average_rate=$ratEe";
$run_update_rate=mysqli_query($connect,$update_rate);
if(isset($_POST['submit'])){
    $rate=$_POST['rate'];
    $insert="INSERT INTO rate VALUES (null,$client_id,$freelancerid,'$rate')";
    $run_insert = mysqli_query($connect, $insert);
    echo "rated done";
    header("refresh:2 ;url=viewprofile.php?view_profile=$freelancerid");
    
}


$select_link = "SELECT * FROM link WHERE freelancer_id = $freelancerid";
$run_select_link = mysqli_query($connect, $select_link);
$number_links = mysqli_num_rows($run_select_link);

$select_sample = "SELECT * FROM sample WHERE freelancer_id = $freelancerid";
$run_sample = mysqli_query($connect, $select_sample);
$number_sample = mysqli_num_rows($run_sample);

if(isset($_SESSION['client_id'])){


    $gannah= "SELECT * FROM payment WHERE client_id=$client_id AND freelancer_id= $freelancerid ";
    $runG=mysqli_query($connect,$gannah);
    $nnum=mysqli_num_rows($runG);
}


$select_comment="SELECT * FROM review JOIN client ON client.client_id=review.client_id where review.freelancer_id=$freelancerid";
$run_comment=mysqli_query($connect,$select_comment);
$num_comment=mysqli_num_rows($run_comment);
if(isset($_POST['add'])){
      $comment=mysqli_real_escape_string($connect,$_POST['comment']);
    if(!empty($comment)){
        $insert_comment="INSERT INTO review values(NULL,$freelancerid,$client_id,'$comment')";
        $run_insert_comment=mysqli_query($connect,$insert_comment);

        $select_client="SELECT 
        client.*,
        ROW_NUMBER() OVER (ORDER BY client.client_id) AS number_client
    FROM 
        client
    WHERE 
        client.client_id = $client_id";
        // $select_client="SELECT client.* ROW_NUMBER() OVER (ORDER BY client.client_id)as`number_client` FROM client WHERE client_id=$client_id";
        $run=mysqli_query($connect,$select_client);
        $hana=mysqli_fetch_assoc($run);
        $select_review="SELECT * FROM review JOIN client ON client.client_id =review.client_id where review.client_id=$client_id";
        $run_review=mysqli_query($connect,$select_review);
$email=$hana['client_email'];
$promocode=$hana['promocode'];
        $number_review=mysqli_num_rows($run_review);

        if( $hana['number_client'] < 15 && $number_review ==1 && !$promocode){

            // $rand=rand(10000,99999);
            $length = 10;    
$rand = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
$update_promocode="UPDATE client SET promocode=$rand where client_id=$client_id";
$run_update_promocode=mysqli_query($connect,$update_promocode);

            $msg="Congratulations!! <br>
            You just received a PROMOCODE with a 5% discount you're free to use it on any future purchase
            <br> 
            your Promocode: $rand";
    
                        // php mail start->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            $mail->setFrom('maloka.elhalawany@gmail.com', 'Tawarod');          //sender mail address , website name
            $mail->addAddress($email);      //reciever mail address
            $mail->isHTML(true);                               
            $mail->Subject = 'Promocode code';             //mail subject
            $mail->Body=($msg);                  //mail content
            $mail->send(); 

        }
        header("location:viewprofile.php?view_profile=$freelancerid");
    }
}
if(isset($_GET['delete'])){
    $id= $_GET['delete'];
    $delete="DELETE FROM review where review_id=$id";
    $run_delete=mysqli_query($connect,$delete);
    header("location:viewprofile.php?view_profile=$freelancerid");
    
}
// if (isset($_GET['viewprofile'])) {
//     $id=$_GET['viewprofile'];
//     $update="UPDATE freelancer SET views = views + 1 WHERE freelancer_id=$id";
//     $runUpdate=mysqli_query($connect, $update);
// }
if(isset($_SESSION['client_id'])){

    $select_member="SELECT * FROM project_members 
JOIN project on project.project_id=project_members.project_id 
JOIN client ON client.client_id=project.client_id
WHERE project_members.freelancer_id=$freelancerid AND project.client_id= $client_id";
$run_member=mysqli_query($connect, $select_member);
$number_member=mysqli_num_rows($run_member);
}
}
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
            if(isset($_SESSION['client_id'])){

            
            $select_wishlist="SELECT * FROM wishlist where client_id=$client_id AND freelancer_id=$freelancerid";
            $run_wishlist=mysqli_query($connect,$select_wishlist);
            $number_wishlist=mysqli_num_rows($run_wishlist);
   if(isset($_POST['wishlist'])){
    if($number_wishlist==0){
        $insert_wishlist="INSERT INTO wishlist VALUES ($client_id,$freelancerid)";
        $run_insert_wishlist=mysqli_query($connect,$insert_wishlist);
            
            header("location:viewprofile.php?view_profile=$freelancerid");
    }else{
    $delete_wishlist="DELETE FROM wishlist where client_id=$client_id AND freelancer_id=$freelancerid";
        $run_delete_wishlist=mysqli_query($connect,$delete_wishlist);
        
        header("location:viewprofile.php?view_profile=$freelancerid");
    }
   }         
}

?>


<!DOCTYPE html>
<html lang="en">
    
    <head>
        
        
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">





    <link rel="stylesheet" href="./css/viewprofile.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Lancelot&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>viewprofile</title>
</head>

<body>








    <div class="main">

        <div class="main-first">

            <div class="info">


                <div class="img">
                    <img src="<?php echo "images/". $img; ?>" alt="">
                </div>
                <h3>
                <?php echo $name; ?>
                </h3>

                <h5>
                <?php echo $category; ?>
                </h5>

                <!-- --------------------------avarage rate----------------------- -->
                <div class="rev-icon">
                    <span>
                        
                        <?php echo $ratEe; ?></p>

                            <i class="fa-solid fa-star" style="color: black;"></i>

                        </a>
                    </span>
                </div>
                <!-- --------------------------avarage rate----------------------- -->


            </div>

            <div class="links">
    <h1>Links</h1>
    <?php
    if ($number_links > 0) {
        foreach ($run_select_link as $link) { 
            echo  '<p><a target="_blank" href="' . $link['link'] . '">' . $link['link'] . '</a></p>';
        }
    } else {
        echo "<p>No links uploaded yet.</p>";
    }
    ?>

    <!-- <a href="# link el facebook"> 
        <i class="fa-brands fa-facebook"></i> Facebook
    </a>

    <a href="link el whatsaap"> 
        <i class="fa-brands fa-whatsapp" style="color: green;"></i> WhatsApp
    </a>

    <a href="link el insta"> 
        <i class="fa-brands fa-instagram" style="color: purple;"></i> Instagram
    </a>

    <a href="link el linkedin"> 
        <i class="fa-brands fa-linkedin"></i> LinkedIn
    </a> -->
</div>


<?php if(isset($_SESSION['client_id'])){
if($nnum>0) { ?>
            <div class="links">
            <form method="POST">
                <div class="rate">
                    
                    <input type="radio" id="star5" name="rate" value="5" />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="rate" value="4" />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="rate" value="3" />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="rate" value="2" />
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="rate" value="1" />
                    <label for="star1" title="text">1 star</label>
                    
                    
                  </div>
                  <button class="add" type="submit" name="submit">Submit</button>
                  </form>
            </div>
            <?php  }} ?>
        </div>




        <div class="main-sec">


        <div class="information">
            <?php if(isset($_SESSION['client_id'])) { ?>
                <a href="request_form.php?freelancer=<?php echo $freelancerid ?>" class="add"> Hire me <span> <i class="fa-solid fa-plus fa-bounce"></i></span></a>
                <?php } ?>

                <p class="pinfo">Full Name : <?php echo $name; ?> </p>
                <p class="pinfo">Email :<?php echo $email; ?> </p>
                <p class="pinfo">Rank: <?php echo $rank; ?></p> <hr>
                <p>Portal :<?php if(isset($price)){ echo $price;} ?> $/H </p>
                <p>FreeLancer : <?php if(isset($price_per_hour)){ echo $price_per_hour;} ?>$/H </p>
                <p>Hours Availble: <?php echo $hours; ?>/H
                <p>views: <?php echo $views; ?></p>
            
                
                </p>

                <a href="popup_report.php?view_profile=<?php echo $freelancerid ?>">report<i class="fa-solid fa-flag" style="color: #ff0000;"></i></a>
                <!-- ------------------------------savebtn--------------------------------- -->
                <?php if(isset($_SESSION['client_id'])){ ?>
                <div class="save" >
                <form action="" method="POST">
                <?php  if($number_wishlist==0) { ?>
                    
                    <button name="wishlist" class="savebtn1" type="submit"><i class="fa-regular fa-bookmark" style="color: #c18d52;"></i></button>
                    <?php }else{ ?>
                        <button class="savebtn" type="button" onclick="showPopup()"  ><i class="fa-solid fa-bookmark" style="color: #c18d52;" ></i></button>
                </form>
                <?php }}?>
             </div>
            
             <!-- ------------------------------savebtn--------------------------------- -->
        </div>
   
            <div class="upload">



                <div class="main-sample">




                    <!-- start here -->



                    <?php if ($number_sample > 0){ ?>
                        <?php foreach ($run_sample as $sample){ ?>
<div class="sample">
        <div class="info">
                <h3><?php echo $sample['sample_name']; ?></h3>
                <p><?php echo $sample['sample_desc']; ?></p>

        </div>
        <div class="view-sample">
            <a href="" Download="<?php echo $sample ['sample_file'] ?>">Download</a>
        </div>
    </div>
    
    <?php } ?>
<?php  } else { ?>
        <p>No samples uploaded yet.</p>
    <?php } ?>
    
    <div class="upload">
        <div class="projects">
            <div id="Project1" class="tab-content">
            <h4>Reviews</h4>

            <?php if($num_comment > 0){ ?>
                <?php foreach($run_comment as $comment){ ?>
                    
                        <ul class="comment-list">
                <li><?php echo $comment['client_name'];?> :<?php echo $comment['text']; ?>
                <?php
                 if(isset($_SESSION['client_id'])){

                if($client_id == $comment['client_id']){ ?>
                <a class="delete-comment" href="viewprofile.php?view_profile=<?php echo $freelancerid?>&&delete=<?php echo $comment['review_id']; ?>">Delete</a>
                <?php } ?>
            </li>
                <!-- <a href="request_form.php?freelancer=<?php// echo $freelancer_id ?>">request</a> -->

            </ul>
                    <?php } ?>
                <?php } ?>
            <?php }else{ ?>
                <p>No comments yet.</p>
            <?php } ?>
        </div>
    </div>
</div>


<?php if(isset($_SESSION['client_id'])){
if($nnum>0) { ?>
                        <form method="POST">
                        <div class="task-bar">
                            <input type="text" id="taskInput1" name="comment" placeholder="Write a comment">
                            <button type="submit" name="add">Add Review</button>
                        </div>
                        <?php } } ?>
                        </form>
                    </div>

                </div>
                




            </div>

        </div>



    </div>

         <!-- ------------------------------unsave popup-------------------------------->
         <div class="container-save d-none" id="unsave">
         <form action="" method="POST">
        <div class="cookiesContent" id="cookiesPopup">
            
             <button class="close" type="submit" onclick="closePopup1()">✖</button>
             <img src="./images/unsave.png" alt="cookies-img" />
             <p>Are You Sure You Want To Unsave This Profile?</p>
            
            <button class="accept" name="wishlist" type="submit">Yes</button>
          
        </div>
        </form>
    </div>
    <?php if(!empty($_SESSION['client_id'])) { ?>
    <div class="chat-box" onclick="openChat()">
        <h1>
            <a href="speak.php?view_profile=<?php echo $freelancerid?>"><i class="fa-solid fa-comment"></i></a>
        </h1>
    </div>
    <?php } ?>
    <script >
        var popup1 = document.getElementById("unsave")

function showPopup() {
popup1.classList.remove('d-none');
}
function closePopup1(){
popup1.classList.add("d-none")
}
      
    </script>
    <script>
        const body = document.querySelector('body'),
            sidebar = body.querySelector('nav'),
            toggle = body.querySelector(".toggle"),
            searchBtn = body.querySelector(".search-box"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text");
        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        })
        searchBtn.addEventListener("click", () => {
            sidebar.classList.remove("close");
        })
        modeSwitch.addEventListener("click", () => {
            body.classList.toggle("dark");
            if (body.classList.contains("dark")) {
                modeText.innerText = "Light mode";
            } else {
                modeText.innerText = "Dark mode";
            }
        });


    </script>
    
    <script>
         var chatContainer = document.getElementById('container');

function openChat() {
    chatContainer.classList.toggle('d-none')
}
function closeChat() {
    chatContainer.classList.add('d-none')
}
    </script>

</body>

</html>
