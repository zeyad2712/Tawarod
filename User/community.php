<?php
// include 'connection.php';
include 'nav.php';


if(isset($_SESSION['client_id'] )){
$client_id=$_SESSION['client_id'];

}else{
    $client_id=NULL;

}
if(isset($_SESSION['freelancer_id'] )){
    $freelancer_id=$_SESSION['freelancer_id'];
    
    }else{
    $freelancer_id=NULL;

    }
$select_post = "SELECT * FROM `c.posts` left JOIN `client` ON `client`.`client_id`= `c.posts`.`client_id`
 left JOIN `freelancer` ON `freelancer`.`freelancer_id`=`c.posts`.`freelancer_id`order by `c.posts`.`c.post_id`desc ";

$run_post = mysqli_query($connect, $select_post);
if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    $delete = "DELETE FROM `c.posts` WHERE `c.post_id` = $post_id";
    $run_delete = mysqli_query($connect, $delete);
    header("location:community.php");
    exit();
}




$filter = false;
$filter_cat = false;
$category_filter = '';
$filtered_posts = [];
if(isset($_SESSION['client_id'] )){
    if (isset($_POST['filter'])) {
$client_id=$_SESSION['client_id'];


    $filter = true;
    $select_filter = "SELECT * FROM `c.posts`
left JOIN `client` on `client`.`client_id`= `c.posts`.`client_id`
left JOIN `freelancer` on `freelancer`.`freelancer_id`=`c.posts`.`freelancer_id`

                  WHERE   `c.posts`.`client_id` = '$client_id' order by `c.posts`.`c.post_id`desc ";
    $filtered_my_posts = mysqli_query($connect, $select_filter);
}
}else{
    if(isset($_SESSION['freelancer_id'] )){

    
    
    if (isset($_POST['filter'])) {
        $freelanser_id=$_SESSION['freelancer_id'];
        
        $filter = true;
        $select_filter = "SELECT * FROM `c.posts`
   left JOIN `client` on `client`.`client_id`= `c.posts`.`client_id`
left JOIN `freelancer` on `freelancer`.`freelancer_id`=`c.posts`.`freelancer_id`

        
                            WHERE `c.posts`.`freelancer_id` = '$freelanser_id'order by `c.posts`.`c.post_id`desc ";
            $filtered_my_posts = mysqli_query($connect, $select_filter);
        }
        
    }

}
if(isset($_SESSION['client_id'] )){
    $client_id=$_SESSION['client_id'];
    $freelancer_id=NULL;
    
    if(isset($_GET['cpost_id'])){

        $like=1;
    
        $client_id=$_SESSION['client_id'];
        $cpost_id=$_GET['cpost_id'];
        $select_like="SELECT * FROM `react` WHERE `client_id`=$client_id AND `c.post_id`=$cpost_id";
        $run_like=mysqli_query($connect,$select_like);
        $num=mysqli_num_rows($run_like);
        if($num>0){
            $fetch=mysqli_fetch_assoc($run_like);
            $action =$fetch['action'];
            if($action==1){
                $delete_like="DELETE FROM `react`WHERE `client_id`=$client_id AND `c.post_id`=$cpost_id"; 

        $run_like=mysqli_query($connect,$delete_like);

            }else{
                $update_react="UPDATE `react` SET `action`=1 WHERE `client_id`= $client_id AND `c.post_id`=$cpost_id";
                $run_like=mysqli_query($connect,$update_react);
            }
        }else{


        $insertl="INSERT INTO `react` VALUES (NULL , '$like' , '$cpost_id' , ' $client_id' ,NULL )";
        $run_insertl=mysqli_query( $connect , $insertl);
        header("location:community.php");}
        
    }
    if(isset($_GET['cpostX_id'])){

        $like=0;
    
        $client_id=$_SESSION['client_id'];
        $cpost_id=$_GET['cpostX_id'];
        
        $select_dislike="SELECT * FROM `react` WHERE `client_id`=$client_id AND `c.post_id`=$cpost_id";
        $run_dislike=mysqli_query($connect,$select_dislike);
        $num=mysqli_num_rows($run_dislike);
        if($num>0){
            $fetch=mysqli_fetch_assoc($run_dislike);
            $action =$fetch['action'];
            if($action==0){
                $delete_dislike="DELETE FROM `react`WHERE `client_id`=$client_id AND `c.post_id`=$cpost_id"; 

        $run_dislike=mysqli_query($connect,$delete_dislike);

            }else{
                $update_react="UPDATE `react` SET `action`=0 WHERE `client_id`=$client_id AND `c.post_id`=$cpost_id";
                $run_dislike=mysqli_query($connect,$update_react);
            }
        }else{

     

        $insertl="INSERT INTO `react` VALUES (NULL , '$like' , '$cpost_id' , ' $client_id' ,NULL )";
        $run_insertl=mysqli_query( $connect , $insertl);
        header("location:community.php"); }
        
    }
}
if(isset($_SESSION['freelancer_id'] )){
    $freelancer_id=$_SESSION['freelancer_id'];
    $client_id=NULL;
    
    if(isset($_GET['cpost_id'])){

        $like=1;
    
        $freelanser_id=$_SESSION['freelancer_id'];
        $cpost_id=$_GET['cpost_id'];
        

        $select_like="SELECT * FROM `react` WHERE `freelancer_id`=$freelancer_id AND `c.post_id`=$cpost_id";
        $run_like=mysqli_query($connect,$select_like);
        $num=mysqli_num_rows($run_like);
        if($num>0){
            $fetch=mysqli_fetch_assoc($run_like);
            $action =$fetch['action'];
            if($action==1){
                $delete_like="DELETE FROM `react`WHERE `freelancer_id`=$freelancer_id AND `c.post_id`=$cpost_id"; 

        $run_like=mysqli_query($connect,$delete_like);

            }else{
                $update_react="UPDATE `react` SET `action`=1 WHERE `freelancer_id`=$freelancer_id AND `c.post_id`=$cpost_id";
                $run_dislike=mysqli_query($connect,$update_react);
            }
        }else{
        $insertl="INSERT INTO `react` VALUES (NULL , '$like' , '$cpost_id' , NULL ,'$freelancer_id' )";
        $run_insertl=mysqli_query( $connect , $insertl);}
        // header("location:community.php");
        
    }
    if(isset($_GET['cpostX_id'])){

        $like=0;
    
        $freelancer_id=$_SESSION['freelancer_id'];
        $cpost_id=$_GET['cpostX_id'];
        
        $select_dislike="SELECT * FROM `react` WHERE `freelancer_id`=$freelancer_id AND `c.post_id`=$cpost_id";
        $run_dislike=mysqli_query($connect,$select_dislike);
        $num=mysqli_num_rows($run_dislike);
        if($num>0){
            $fetch=mysqli_fetch_assoc($run_dislike);
            $action =$fetch['action'];
            if($action==0){
                $delete_dislike="DELETE FROM `react`WHERE `freelancer_id`=$freelancer_id AND `c.post_id`=$cpost_id"; 

        $run_dislike=mysqli_query($connect,$delete_dislike);

            }else{
                $update_react="UPDATE `react` SET `action`=0 WHERE `freelancer_id`=$freelancer_id AND `c.post_id`=$cpost_id";
                $run_dislike=mysqli_query($connect,$update_react);
            }
        }else{

            
                    $insertl="INSERT INTO `react` VALUES (NULL , '$like' , '$cpost_id' , NULL ,'$freelancer_id' )";
                    
                    $run_insertl=mysqli_query( $connect , $insertl);
        }

        // header("location:community.php");
        
    }
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
    <link rel="stylesheet" href="./css/community.css">
</head>

<body>
    <div class="container">
        <header class="header">
            <h1>Our Community</h1>
        </header>

        <section class="buttons">
            <form action=""method="POST">
            <button>
               <a href="add_c.post.php">add<i class="fa-solid fa-plus"></i></a> 
            </button>
            <button type="submit">
                All Posts
            </button>
            <button name="filter" type="submit">
                My Posts
            </button>
            </form>
        </section>

        <main class="posts">
<?php if(isset($_POST['filter'])){ ?>
    <?php foreach($filtered_my_posts as $data)  {                 ?>

        <div class="img-name">
                <?php if($data['freelancer_id']==NULL) { ?>
            <img src=" <?php echo "images/". $data ['client_image']?>" alt="">
            <h2><?php echo $data['client_name']; ?> </h2>
            <?php } else{ ?>
                <img src=" <?php echo "images/". $data ['freelancer_image']?>" alt="">
        <h2><?php echo $data['freelancer_name']; ?> </h2>
        <?php } ?>
            </div>
            <article class="post">
            
                <div class="post-content">
                    <div class="icon">
                    <p class="post-snippet"><?php echo $data['c.post_desc']; ?> </p>
    <a href="community.php?delete=<?php echo $data ['c.post_id']?>" class="delete-btn" name="delete" data-post-id="post1"><i class="fa-solid fa-trash-can" style="color: #203b37;"></i></a>
                   
                </div>
                    <div class="p-img"><?php if($data ['p.image']!=NULL){ ?>
            <img src=" <?php echo "images/". $data ['p.image']?>" alt=""width="300px">
            <?php } ?>
</div>
            
                    <a class="read-more" href="c.post_details.php?c.post_id=<?php echo $data ['c.post_id']?>">comment  <i class="fa-regular fa-comment" style="color: #0a0a0a;"></i></a>
                </div>
            </article>
            <?php } ?>
            <?php }  else{ ?>
                <?php foreach($run_post as $data)  {                 ?>
                    <?php $cpost_id=$data['c.post_id'];?>
       <?php $like_count="SELECT * FROM `react` WHERE `c.post_id`=$cpost_id AND`action`=1"; 
$run_like=mysqli_query($connect , $like_count);
$nlike=mysqli_num_rows($run_like); ?>
<?php $dislike_count="SELECT * FROM `react` WHERE `c.post_id`=$cpost_id AND`action`=0"; 
$run_dislike=mysqli_query($connect , $dislike_count);
$ndislike=mysqli_num_rows($run_dislike); ?>

<div class="img-name">
<?php if($data['freelancer_id']==NULL) { ?>
    <img src=" <?php echo "images/". $data ['client_image']?>" alt="">
    <h2><?php echo $data['client_name']; ?> </h2>
    <?php } else{ ?>
        <img src=" <?php echo "images/". $data ['freelancer_image']?>" alt="">
<h2><?php echo $data['freelancer_name']; ?> </h2>
<?php } ?>
    </div>
    <article class="post">
    
        <div class="post-content">
            <div class="icon">
            <p class="post-snippet"><?php echo $data['c.post_desc']; ?> </p>
           
        </div>
            <div class="p-img"><?php if($data ['p.image']!=NULL){ ?>
    <img src=" <?php echo "images/". $data ['p.image']?>" alt=""width="300px">
    <?php } ?>
</div>

<!-- hana han3l el condition beta3 el like w dis -->
<?php if(isset($_SESSION['client_id'])) {
  
     $select_likee="SELECT * FROM `react` WHERE `client_id`=$client_id AND `c.post_id`=$cpost_id AND `action`=1";
     $run_likee=mysqli_query($connect,$select_likee);
     $numberl=mysqli_num_rows($run_likee);
     if($numberl >0){ ?>
    <a href="community.php?cpost_id=<?php echo $data ['c.post_id']?> "class="read-more btn"  class="read-more btn" onclick="toggleLike(this)"><i class="fa-solid fa-thumbs-up" style="color: #0c0d0d;"></i></a><?php echo $nlike ?>
    <?php }else { ?>
        <a href="community.php?cpost_id=<?php echo $data ['c.post_id']?> "class="read-more btn"  class="read-more btn" onclick="toggleLike(this)"><i class="fa-regular fa-thumbs-up" style="color: #0c0d0d;"></i></a><?php echo $nlike ?>
<?php } ?>
<?php         $select_dislikee="SELECT * FROM `react` WHERE `client_id`=$client_id AND `c.post_id`=$cpost_id AND `action`=0";
        $run_dislikee=mysqli_query($connect,$select_dislikee);
        $numberd=mysqli_num_rows($run_dislikee);
        if($numberd >0){ ?>
            <a href="community.php?cpostX_id=<?php echo $data ['c.post_id']?>" class="read-more btn" onclick="toggleDislike(this)"><i class="fa-solid fa-thumbs-down" style="color: #000000;"></i></a><?php echo $ndislike ?>
            <?php }else { ?>
            
            <a href="community.php?cpostX_id=<?php echo $data ['c.post_id']?>" class="read-more btn" onclick="toggleDislike(this)"><i class="fa-regular fa-thumbs-down" style="color: #000000;"></i></a><?php echo $ndislike ?>
            <?php } }else{ ?>
              









          






              <?php   $select_likes="SELECT * FROM `react` WHERE (`freelancer_id`=$freelancer_id) AND (`c.post_id`=$cpost_id) AND(`action`=1)";
        $run_likes=mysqli_query($connect,$select_likes);
     $number2=mysqli_num_rows($run_likes);
     if($number2 >0){ ?>
    <a href="community.php?cpost_id=<?php echo $data ['c.post_id']?> "class="read-more btn"  class="read-more btn" onclick="toggleLike(this)"><i class="fa-solid fa-thumbs-up" style="color: #0c0d0d;"></i></a><?php echo $nlike ?>
    <?php }else { ?>
        <a href="community.php?cpost_id=<?php echo $data ['c.post_id']?> "class="read-more btn"  class="read-more btn" onclick="toggleLike(this)"><i class="fa-regular fa-thumbs-up" style="color: #0c0d0d;"></i></a><?php echo $nlike ?>
<?php } ?>
<?php       $select_dislikes="SELECT * FROM `react` WHERE `freelancer_id`=$freelancer_id AND `c.post_id`=$cpost_id AND `action`=0";
        $run_dislikes=mysqli_query($connect,$select_dislikes);
        $numberd1=mysqli_num_rows($run_dislikes);
        if($numberd1 >0){ ?>
            <a href="community.php?cpostX_id=<?php echo $data ['c.post_id']?>" class="read-more btn" onclick="toggleDislike(this)"><i class="fa-solid fa-thumbs-down" style="color: #000000;"></i></a><?php echo $ndislike ?>
            <?php }else { ?>
            
            <a href="community.php?cpostX_id=<?php echo $data ['c.post_id']?>" class="read-more btn" onclick="toggleDislike(this)"><i class="fa-regular fa-thumbs-down" style="color: #000000;"></i></a><?php echo $ndislike ?>
            

            <?php } }?>
            <a class="read-more" href="c.post_details.php?cpostm_id=<?php echo $data ['c.post_id']?>">comment  <i class="fa-regular fa-comment" style="color: #0a0a0a;"></i></a>
        </div>
    </article>
    <?php } ?>
    <?php } ?>
          

        
                
            <!-- Additional posts can be added here -->
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        function toggleLike(button) {
            const icon = button.querySelector('i');
            const dislikeButton = button.nextElementSibling; // Get the dislike button
            const dislikeIcon = dislikeButton.querySelector('i'); // Get the dislike icon

            // Toggle the like button
            if (icon.classList.contains('fa-solid')) {
                icon.classList.remove('fa-solid');
                icon.classList.add('fa-regular');
            } else {
                // Turn off dislike if it's active
                if (dislikeIcon.classList.contains('fa-solid')) {
                    dislikeIcon.classList.remove('fa-solid');
                    dislikeIcon.classList.add('fa-regular');
                }
                icon.classList.remove('fa-regular');
                icon.classList.add('fa-solid');
            }
        }

        function toggleDislike(button) {
            const icon = button.querySelector('i');
            const likeButton = button.previousElementSibling; // Get the like button
            const likeIcon = likeButton.querySelector('i'); // Get the like icon

            // Toggle the dislike button
            if (icon.classList.contains('fa-solid')) {
                icon.classList.remove('fa-solid');
                icon.classList.add('fa-regular');
            } else {
                // Turn off like if it's active
                if (likeIcon.classList.contains('fa-solid')) {
                    likeIcon.classList.remove('fa-solid');
                    likeIcon.classList.add('fa-regular');
                }
                icon.classList.remove('fa-regular');
                icon.classList.add('fa-solid');
            }
        }
    </script>
</body>

</html>
