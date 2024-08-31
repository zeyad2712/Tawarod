<?php
// include("connection.php");
include "nav.php";

if(isset($_GET['freelancers'])){
$id=$_GET['freelancers'];
$select = "SELECT * FROM `category`  JOIN `freelancer`  
ON `category`.`cat_id` = `freelancer`.`cat_id` WHERE `freelancer`.`cat_id`= 7 AND `freelancer`.`hide`=0 ";
$run=mysqli_query($connect, $select);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>category</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="./css/all-freelancer.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body>

<div class="main">
        <?php 
        foreach ($run as $data) { ?>
      <a href="./viewprofile.php?view_profile=<?php echo $data['freelancer_id'] ?>" class="card">
            <div class="img">
                <img src="./images/360_F_243123463_zTooub557xEWABDLk0jJklDyLSGl2jrr.jpg" alt="logo">
            </div>
            <div class="info">
                <h2><?php echo $data['freelancer_name'] ?></h2>
                <p class="title"><?php echo $data['job_title'] ?></p>
                <p class="rate"><i class="fa-solid fa-star"><?php echo $data['average_rate'] ?></i></p>
            </div>
            <!-- <a href="./view_profile.php?view_profile=<?php echo $id ?>" class="category-mrk"> view profile </a> -->

        </a>
        <?php } ?>
    </div>
    </div>
    </div>
</body>
</html>

