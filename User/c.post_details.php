<?php
include 'nav.php';

if(isset($_GET['cpostm_id'])){
    $cpost_id=$_GET['cpostm_id'];
    
    $select_post = "SELECT * FROM `c.posts` left JOIN `client` ON `client`.`client_id`= `c.posts`.`client_id`
 left JOIN `freelancer` ON `freelancer`.`freelancer_id`=`c.posts`.`freelancer_id` where `c.post_id`=$cpost_id";

$run_post = mysqli_query($connect, $select_post);
$fetch=mysqli_fetch_assoc($run_post);
$cl=$fetch['client_id'];
$fl=$fetch['freelancer_id'];
if(!empty($fl)){
$user=$fetch['freelancer_name'];
$imgg=$fetch['freelancer_image'];
}else{
    $user=$fetch['client_name'];
$imgg=$fetch['client_image'];

}
$desc=$fetch['c.post_desc'];
$img=$fetch['p.image'];

}
if(isset($_SESSION['client_id'] )){
    $client_id=$_SESSION['client_id'];
    $freelancer_id=NULL;
    if(isset($_GET['cpostm_id'])){
        $cpost_id=$_GET['cpostm_id'];
    }
        if(isset($_POST['co'])){

            $client_id=$_SESSION['client_id'];
            $ccomment= $_POST['comment'];
            
            
            $insertl="INSERT INTO `c_comments` VALUES (NULL , '$ccomment' , '$client_id' , NULL ,'$cpost_id' )";
            $run_insertl=mysqli_query( $connect , $insertl);
            
            header("location:c.post_details.php?cpostm_id=$cpost_id");
        }
        
            
        
}
if(isset($_SESSION['freelancer_id'] )){
    $freelancer_id=$_SESSION['freelancer_id'];
    $client_id=NULL;
    
    if(isset($_GET['cpostm_id'])){
        $cpost_id=$_GET['cpostm_id'];
    }
        if(isset($_POST['co'])){

            $freelancer_id=$_SESSION['freelancer_id'];
            $ccomment=$_POST['comment'];
            
            
            $insertl="INSERT INTO `c_comments` VALUES (NULL , '$ccomment' , NULL , '$freelancer_id','$cpost_id' )";
            $run_insertl=mysqli_query( $connect , $insertl);
        
            header("location:c.post_details.php?cpostm_id=$cpost_id");
                
        }
}
if(isset($_GET['cpostm_id'])){
    $cpost_id=$_GET['cpostm_id'];
    $_SESSION['commm']=$cpost_id;
    // $fetch1=mysqli_fetch_assoc($run_select);
    // $cl=$fetch['client_id'];
    // $fl=$fetch['freelancer_id'];
    // if(!empty($fl)){
        //     $user1=$fetch['freelancer_name'];
        //     }else{
            //         $user1=$fetch['client_name'];
            //     }
            
        }
        $cpost_id=$_SESSION['commm'];
        $select_com="SELECT * FROM `c_comments` 
        left join `freelancer` on `freelancer`.`freelancer_id`=`c_comments`.`freelancer_id`
        left join `client` on `client`.`client_id`=`c_comments`.`client_id`
        
        WHERE `c.post_id`= $cpost_id ";
        $run=mysqli_query($connect,$select_com);
        if(isset($_GET['delete'])){
            $id=$_GET['delete'];
            $delete_query="DELETE FROM c_comments WHERE  c_comment_id=$id";
            $run_delete=mysqli_query($connect,$delete_query);
            header("location: c.post_details.php?cpostm_id=$cpost_id");
        }

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts Page</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lancelot&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/postdetails-community.css">
</head>

<body>
    <svg id="wave" style="transform:rotate(180deg); transition: 0.3s" viewBox="0 0 1440 180" version="1.1"
        xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0">
                <stop stop-color="rgba(8, 27, 27, 1)" offset="0%"></stop>
                <stop stop-color="rgba(53.618, 136.204, 136.204, 1)" offset="100%"></stop>
            </linearGradient>
        </defs>
        <path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)"
            d="M0,0L40,24C80,48,160,96,240,105C320,114,400,84,480,72C560,60,640,66,720,84C800,102,880,132,960,120C1040,108,1120,54,1200,39C1280,24,1360,48,1440,57C1520,66,1600,60,1680,57C1760,54,1840,54,1920,54C2000,54,2080,54,2160,60C2240,66,2320,78,2400,81C2480,84,2560,78,2640,78C2720,78,2800,84,2880,75C2960,66,3040,42,3120,54C3200,66,3280,114,3360,123C3440,132,3520,102,3600,96C3680,90,3760,108,3840,111C3920,114,4000,102,4080,105C4160,108,4240,126,4320,120C4400,114,4480,84,4560,63C4640,42,4720,30,4800,42C4880,54,4960,90,5040,93C5120,96,5200,66,5280,51C5360,36,5440,36,5520,45C5600,54,5680,72,5720,81L5760,90L5760,180L5720,180C5680,180,5600,180,5520,180C5440,180,5360,180,5280,180C5200,180,5120,180,5040,180C4960,180,4880,180,4800,180C4720,180,4640,180,4560,180C4480,180,4400,180,4320,180C4240,180,4160,180,4080,180C4000,180,3920,180,3840,180C3760,180,3680,180,3600,180C3520,180,3440,180,3360,180C3280,180,3200,180,3120,180C3040,180,2960,180,2880,180C2800,180,2720,180,2640,180C2560,180,2480,180,2400,180C2320,180,2240,180,2160,180C2080,180,2000,180,1920,180C1840,180,1760,180,1680,180C1600,180,1520,180,1440,180C1360,180,1280,180,1200,180C1120,180,1040,180,960,180C880,180,800,180,720,180C640,180,560,180,480,180C400,180,320,180,240,180C160,180,80,180,40,180L0,180Z">
        </path>
        <defs>
            <linearGradient id="sw-gradient-1" x1="0" x2="0" y1="1" y2="0">
                <stop stop-color="rgba(193, 141, 82, 1)" offset="0%"></stop>
                <stop stop-color="rgba(193, 141, 82, 1)" offset="100%"></stop>
            </linearGradient>
        </defs>
        <path style="transform:translate(0, 50px); opacity:0.9" fill="url(#sw-gradient-1)"
            d="M0,0L40,0C80,0,160,0,240,15C320,30,400,60,480,87C560,114,640,138,720,129C800,120,880,78,960,54C1040,30,1120,24,1200,42C1280,60,1360,102,1440,108C1520,114,1600,84,1680,69C1760,54,1840,54,1920,63C2000,72,2080,90,2160,90C2240,90,2320,72,2400,54C2480,36,2560,18,2640,27C2720,36,2800,72,2880,93C2960,114,3040,120,3120,114C3200,108,3280,90,3360,90C3440,90,3520,108,3600,108C3680,108,3760,90,3840,96C3920,102,4000,132,4080,123C4160,114,4240,66,4320,48C4400,30,4480,42,4560,63C4640,84,4720,114,4800,120C4880,126,4960,108,5040,108C5120,108,5200,126,5280,123C5360,120,5440,96,5520,72C5600,48,5680,24,5720,12L5760,0L5760,180L5720,180C5680,180,5600,180,5520,180C5440,180,5360,180,5280,180C5200,180,5120,180,5040,180C4960,180,4880,180,4800,180C4720,180,4640,180,4560,180C4480,180,4400,180,4320,180C4240,180,4160,180,4080,180C4000,180,3920,180,3840,180C3760,180,3680,180,3600,180C3520,180,3440,180,3360,180C3280,180,3200,180,3120,180C3040,180,2960,180,2880,180C2800,180,2720,180,2640,180C2560,180,2480,180,2400,180C2320,180,2240,180,2160,180C2080,180,2000,180,1920,180C1840,180,1760,180,1680,180C1600,180,1520,180,1440,180C1360,180,1280,180,1200,180C1120,180,1040,180,960,180C880,180,800,180,720,180C640,180,560,180,480,180C400,180,320,180,240,180C160,180,80,180,40,180L0,180Z">
        </path>
        <defs>
            <linearGradient id="sw-gradient-2" x1="0" x2="0" y1="1" y2="0">
                <stop stop-color="rgba(90, 143, 118, 1)" offset="0%"></stop>
                <stop stop-color="rgba(90, 143, 118, 1)" offset="100%"></stop>
            </linearGradient>
        </defs>
        <path style="transform:translate(0, 100px); opacity:0.8" fill="url(#sw-gradient-2)"
            d="M0,0L40,3C80,6,160,12,240,18C320,24,400,30,480,51C560,72,640,108,720,105C800,102,880,60,960,54C1040,48,1120,78,1200,102C1280,126,1360,144,1440,150C1520,156,1600,150,1680,129C1760,108,1840,72,1920,48C2000,24,2080,12,2160,30C2240,48,2320,96,2400,123C2480,150,2560,156,2640,147C2720,138,2800,114,2880,96C2960,78,3040,66,3120,72C3200,78,3280,102,3360,102C3440,102,3520,78,3600,78C3680,78,3760,102,3840,96C3920,90,4000,54,4080,36C4160,18,4240,18,4320,27C4400,36,4480,54,4560,75C4640,96,4720,120,4800,132C4880,144,4960,144,5040,126C5120,108,5200,72,5280,66C5360,60,5440,84,5520,96C5600,108,5680,108,5720,108L5760,108L5760,180L5720,180C5680,180,5600,180,5520,180C5440,180,5360,180,5280,180C5200,180,5120,180,5040,180C4960,180,4880,180,4800,180C4720,180,4640,180,4560,180C4480,180,4400,180,4320,180C4240,180,4160,180,4080,180C4000,180,3920,180,3840,180C3760,180,3680,180,3600,180C3520,180,3440,180,3360,180C3280,180,3200,180,3120,180C3040,180,2960,180,2880,180C2800,180,2720,180,2640,180C2560,180,2480,180,2400,180C2320,180,2240,180,2160,180C2080,180,2000,180,1920,180C1840,180,1760,180,1680,180C1600,180,1520,180,1440,180C1360,180,1280,180,1200,180C1120,180,1040,180,960,180C880,180,800,180,720,180C640,180,560,180,480,180C400,180,320,180,240,180C160,180,80,180,40,180L0,180Z">
        </path>
    </svg>

    <div class="container">



        <main class="posts">
            <div class="img-name">
        
                <img src="./images/<?php       echo $imgg ;              ?>" alt="A beautiful landscape" class="post-image">
                <h2><?php       echo $user ;              ?></h2>
            </div>
            <article class="post">

                <div class="post-content">
                    <div class="icon">
                        <p class="post-snippet"><?php       echo $desc ;              ?></p>

                    </div>
                    <div class="p-img">
                    <img src="images/<?php       echo $img ;              ?>" alt=""width="300px"></div>

                    <div class="comments">
                        <h2>Comments</h2>
                        <hr>
                        <div class="commentt">
                            <!-- -------------------start looping from hereeeee----------------- -->
<?php foreach($run as $row) {?>

                            <div class="user-info">
                                <!-- <img src="./images/default.jpg" alt="">  UserName<br> -->
                                <?php if($row['freelancer_id']==NULL) { ?>
    <img width="200px" src=" <?php echo "images/". $row ['client_image']?>" alt="">
    <h2><?php echo $row['client_name']; ?> </h2>
    <?php } else{ ?>
        <img src=" <?php echo "images/". $row ['freelancer_image']?>" alt="">
        <h2><?php echo $row ['freelancer_name']; ?> </h2>
        <?php } ?><br>

                                <div class="com1">
                                <p> <?php echo $row ['comment']?></p>
                                <?php $free=$row['freelancer_id'];?>
                               <?php $cli=$row['client_id'];?>
       <?php if($free!= NULL){?>
           <?php if($free==$freelancer_id){?>
<a class="delete-comment" href="c.post_details.php?delete=<?php echo  $row['c_comment_id']?>">Delete <i class="fa-solid fa-trash-can" style="color: #203b37;"></i></a>
<?php }
        } elseif($cli!= NULL){
            if($cli==$client_id){?>
<a class="delete-comment" href="c.post_details.php?delete=<?php echo  $row['c_comment_id']?>">Delete <i class="fa-solid fa-trash-can" style="color: #203b37;"></i></a>
<?php } } ?>
                            

                                </div>
                                <hr>
                            </div>
                            <?php } ?> 
                            <!-- ----------------------------end looping hereeeeeeeeeeeee------------------------ -->


                        </div>


                        <div class="com-form">
<form action="" method="POST">
                            
                                <input  name="comment" type="text" class="comment" placeholder="Add Comment....">
                                <button type="submit" name="co">Add Comment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </article>


        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>