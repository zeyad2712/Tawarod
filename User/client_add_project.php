


<?php
// include "connection.php";

include "nav.php";

$type_id="";
$project_desc="";
$project_name="";
$error="";
$select= "SELECT * from `type` ";
$run = mysqli_query($connect, $select);
// $clien_id=6;
$client_id=$_SESSION['client_id'];
if(isset($_POST['submit'])){
    $project_name=mysqli_real_escape_string($connect,$_POST['projectname']);
    $project_desc=mysqli_real_escape_string($connect,$_POST['projectdesc']);
    $type_id=isset($_POST['type_id'])?$_POST['type_id']:NULL;
if(!empty($project_name) &&!empty($project_desc) &&!empty($type_id)){

    $Insert = "INSERT INTO `project` VALUES (NULL, '$project_name', '$project_desc', '$type_id','$client_id')";
    $run_insert= mysqli_query($connect, $Insert);
    header('location:clientprofile.php');
}else{
    $error="please,put all requierd data";
    echo $error;
}     
}

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
    <title>Document</title>
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
                    <p class="form-titlee">Creat Project</p>
                    <!-- project name -->
                    <label>Project Name:</label>
                    <div class="input-containerr">
                        <input name="projectname" type="text" value="<?php echo $project_name ?>">

                    </div>
                    <!-- project Description -->
                    <label>Project Description:</label>
                    <div class="input-containerr">
                        <input name="projectdesc" id="" value="<?php echo $project_desc ?>"></input>
                     </div>
                    <!-- project type -->
                    <div class="radio-buttons">
                        <label class="type">Project Type:</label> <br> <br>
<?php
 foreach ($run as $data) { ?>
                        <input type="radio" name="type_id" value="<?php echo $data['type_id']?>" id="ind" <?php if($type_id ==$data['type_id']){ echo "checked";}?>>
                        <label for="ind" ><?php echo $data ['type_name']?></label>
                        <?php } ?>
                        
                    </div>
                    <button class="submit" type="submit" Name="submit">
                        Create Project
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