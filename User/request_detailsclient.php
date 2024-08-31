<?php
// include 'connection.php';
include "nav.php";
// $id = $_GET['request_id'] = 28; // Assuming project_id is passed via GET
// $id=29;
if(isset($_GET['request_id'])){
    $id=$_GET['request_id'];
// Fetch request details
$select_request = "SELECT * FROM `request` JOIN `project` ON request.project_id = project.project_id JOIN client ON project.client_id = client.client_id JOIN `type` ON project.type_id= `type`. type_id  WHERE request.request_id = $id";
$run_request = mysqli_query($connect, $select_request);
$fetch = mysqli_fetch_assoc($run_request);
$project_name = $fetch['project_name'];
$client_name = $fetch['client_name'];
$hourst_requested = $fetch['hours_requested'];
$type_name = $fetch['type_name'];
$project_desc = $fetch['project_desc'];

// echo $project_name ,$client_name , $hourst_requested , $type_name, $project_desc;

if(isset($_POST['Approval'])){
    $update="UPDATE `request` SET `request_status` = 'Approval' WHERE  `request_id` = $id "; 
    $run=mysqli_query($connect,$update);
    echo "REQST APPROVED";
}
if(isset($_POST['Decline'])){
    $update="UPDATE `request` SET `request_status` = 'Decline' WHERE  `request_id` = $id "; 
    $run=mysqli_query($connect,$update);
    echo "REQUEST declined";

}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Details Page</title>

    <!-- link google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- link font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- link css file -->
    <link rel="stylesheet" href="./css/request details.css">

</head>

<body>

    <div class="main">
        <div class="request-card">

            <div class="heading">
                <h1>
                    Request Details
                </h1>
            </div>

            <div class="name">
                <h4>
                    Project Name:
                </h4>
                <p> <?php    echo $project_name         ?></p>
            </div>
            <div class="name">
                <h4>
                    Client Name:
                </h4>
                <p> <?php    echo $client_name         ?></p>
            </div>
            <div class="name">
                <h4>
                    Hours Requested: 
                </h4>
                <p><?php   echo $hourst_requested?></p>
            </div>
            <div class="name">
                <h4>
                    Project Type:
                </h4>
                <p> <?php    echo   $type_name       ?></p>
            </div>
            <div class="name">
                <h4>
                    Descreption: 
                </h4>
                <p><?php    echo $project_desc         ?></p>
            </div>

            <div class="buttons">

                <!-- <form method="POST">
                    <button name="Approval" class="btn1" type="submit"><i class="fa-solid fa-check"></i></button>
                    <button name="Decline"  class="btn2" type="submit"><i class="fa-solid fa-xmark"></i></button>
                </form> -->
                
            </div>


        </div>
    </div>






    <!-- link js bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>