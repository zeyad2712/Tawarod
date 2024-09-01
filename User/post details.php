<?php   
// include 'connection.php';
include "nav.php";

// $freelancer_id=13;
$free=FALSE;
if(isset($_SESSION['freelancer_id'])){
$freelancer_id=$_SESSION['freelancer_id'];
$free=TRUE;
}

if(isset($_GET['project_id'])){   
    $project_id=$_GET['project_id'];
    $post_id=$_GET['post_id'];
    // $project_id=$project_id[$_GET['project_id']];
    $select_post="SELECT * FROM posts WHERE project_id =$project_id";
    $run_post=mysqli_query($connect,$select_post);
    $fetch=mysqli_fetch_assoc($run_post);
    $select_project="SELECT * FROM project JOIN client ON project.client_id= client.client_id
JOIN posts ON project.project_id=posts.project_id
JOIN category ON category.cat_id = posts.cat_id
 WHERE project.project_id=$project_id";
$run_project=mysqli_query($connect,$select_project);
$fetch_project=mysqli_fetch_assoc($run_project);
$porject_name=$fetch_project['project_name'];
$post_desc=$fetch_project['post_desc'];
$client_name=$fetch_project['client_name'];
$client_img=$fetch_project['client_image'];
$catt=$fetch_project['cat_name'];
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $delete_query="DELETE FROM comments WHERE  comment_id=$id";
    $run_delete=mysqli_query($connect,$delete_query);
    header("location: post details.php?project_id=$project_id&&post_id=$post_id ");
}

}

if(isset($_POST['submit'])){
    $file=$_FILES['file']['name'];
    $text=mysqli_real_escape_string($connect,$_POST['text']);
    $insert=" INSERT  INTO `comments` VALUES (NULL,'$text','$file',$post_id,$freelancer_id)";
    $RunInsert=mysqli_query($connect,$insert);
        $upload_file=move_uploaded_file($_FILES['file']['tmp_name'], "./images/ " . $file);
//         if($upload_file){
//             header("location:post details.php");
// }

}
$select= "SELECT * FROM comments
JOIN freelancer ON freelancer.freelancer_id=comments.freelancer_id WHERE post_id = $post_id ";
$RunSelect=mysqli_query($connect,$select);
$fectch_comment=mysqli_fetch_assoc($RunSelect);
// $comment=$fectch_comment["text"];



?>
















<!DOCTYPE html>
<html lang="en">
<!-- <form method="POST">  -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/post details.css">
    <!-- gooogle font -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Lancelot&display=swap" rel="stylesheet">

    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <!--  -->
</head>

<body>
    <div class="post-detail">
        <!-- Start post -->
<!-- <form method="GET"> -->
        <div class="post3">
            <div class="personal-info">
            <img src=" <?php echo "images/". $client_img?>" alt="">
                
                <h2>  <?php echo $client_name ?></h2>
               
            </div>

            <h1>    <?php echo $porject_name ?></h1>
            <div class="time">
                <h4><?php echo $catt ?></h4>
                <!-- <p>$120/hr</p> -->
            </div>
            <p>    <?php echo $post_desc  ?> </p>

<!-- <form> -->
            <hr>
            <!-- Comments Section -->
            <div class="projects">
                <div id="Project1" class="tab-content">
                    <h4>Comments</h4>
                    
                    <ul class="comment-list">
                        <?php  foreach ($RunSelect as $key) {?>
                        <li>
      
      <span><a href="viewprofile.php?view_profile=<?php echo $key ['freelancer_id']?>"><?php echo $key ['freelancer_name'] ?></a></span>: <span class="comment-text"><?php  echo $key ['text'] ?> </span> <br> 

      <?php $fr= $key ['freelancer_id'];
       if(!empty($key['files'])){?>
      
        <a href="" Download="<?php echo $key['files']?>"><i
             class="fa-solid fa-download" style="color:black; "></i></a>
<?php } else{?>
<p>no file </p>
<?php } ?> <?php
      if ($free){
        if($fr == $freelancer_id){
            ?>
            <div class="d-comm">
        <a class="delete-comment" href="post details.php?project_id=<?php echo $project_id ?>&&post_id=<?php echo $post_id ?>&&delete=<?php echo  $key['comment_id']?>">Delete</a><br>
        </div>


      </li>
                        <?php } }}?>
                    </ul>
                    
     
                </div>
            </div>
            <div class="task-bar">
                <?php if($free){ ?>
                    <form method="POST" enctype="multipart/form-data">
                <input name="text" type="text" class="taskInput1" id="taskInput1" placeholder="Write a comment">
                <label for="choose" class="add-btn"> Attach </label>

                <input type="file" class="file-inpt" id="choose" name="file">
                <button type="submit" name="submit">Add Comment</button>



            </form>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
    <script src="./js/post details.js"></script>
</body>

</html>
