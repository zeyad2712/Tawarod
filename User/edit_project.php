<?php
// include "connection.php";
include "nav.php";



$select= "SELECT * from `type` ";
$run_select = mysqli_query($connect, $select);
$client_id=$_SESSION['client_id'];
// $project_id=5;
$error="";
if (isset($_GET['edit'])) {
    $project_id = $_GET['edit'];
    $select_project = "SELECT * FROM `project`  WHERE `project_id` = $project_id ";
    $run_select_project = mysqli_query($connect, $select_project);
    $fetch= mysqli_fetch_assoc($run_select_project);
    $project_name=$fetch['project_name'];
    $project_desc=$fetch['project_desc'];
    $type_id=$fetch['type_id'];
if(isset($_POST['submit'])){
    $project_name=$_POST['project_name'];
    $project_desc=$_POST['project_desc'];
    $type_id=$_POST['type_id'];
//  $update = "UPDATE `project` SET `project_name` = '$project_name', `project_desc` = '$project_desc', `type_id` = '$type_id'
//   WHERE `project_id` = '$project_id' AND `client_id` = '$client_id'";
//  $run_update = mysqli_query($connect, $update);
 if(!empty($project_desc) && !empty($project_name)){
    $update = "UPDATE `project` SET `project_name` = '$project_name', `project_desc` = '$project_desc', `type_id` = '$type_id'
    WHERE `project_id` = '$project_id' AND `client_id` = '$client_id'";
   $run_update = mysqli_query($connect, $update);
    if ($run_update) {
        $error="project updated successfully!";
        header("location:clientprofile.php");
    } else {
        $error= "Failed to update project!";
    }
}else{
    $error="please put the required data";
}
 
}}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ---------------------------------bootstrap link------------------------- -->
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
    <title>Edit Project</title>
    <!-- ---------------------------css link------------------------------- -->
    <link rel="stylesheet" href="./css/add project(client).css">
</head>

<body>
    <div class="mainn">
        <div class="main-cardd">
            <!-- <div class="error-section">
                <h4>Invald Input</h4>
            </div> -->
            <div class="contentt">
                <form class="form" method="POST">
                    <p class="form-titlee">Edit Project</p>
                    <!-- project name -->
                    <label>Project Name:</label>
                    <div class="input-containerr">
                        <input name="project_name" type="text" value="<?php echo $project_name ?>">
                    </div>
                    <!-- project Description -->
                    <label>Project Description:</label>
                    <div class="input-containerr">
                        <input name="project_desc" id="" value="<?php echo $project_desc ?>" ></input>
                    </div>


                    <!-- project type -->
                    <div class="radio-buttons">
                        <label class="type">Project Type:</label> <br> 
                        <input type="radio" name="type_id" value="1" id="ind" <?php echo ($type_id == 1) ? 'checked' : ''; ?>>
                        <label for="ind" >Individual</label>
                        <input type="radio" name="type_id" value="2" id="team" <?php echo ($type_id == 2) ? 'checked' : ''; ?>>
                        <label for="team">Team</label>
                    </div>
                    
                
                    <!-- -------------------------error---------------------- -->
                    <div class="error">
                        <p><?php echo $error ?></p>
                    </div>
                    <!-- -------------------------error---------------------- -->
                    <button class="submit" type="submit" Name="submit">
                         Update
                    </button>
                </form>
            </div>
            <img class="img" src="./images/Designer girl-rafiki.png" alt="">
        </div>
    </div>
    </div>
    <!-- link js bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>