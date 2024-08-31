<?php  
include 'nav.php';
$freelancer_id=$_SESSION['freelancer_id'];
// $freelancer_id = 13;
$name="";
$desc="";

 if(isset($_POST['submit'])){
    $file=$_FILES['file']['name'];
    $desc=$_POST['desc'];
    $name=$_POST['name'];
    if(!empty($file) && !empty($desc) && !empty($name)){
        $insert ="INSERT INTO `sample` VALUES (NULL , $freelancer_id, '$file', '$desc', '$name' )";
        $runInsert=mysqli_query($connect,$insert);
        $upload_file=move_uploaded_file($_FILES['file']['tmp_name'], "./images/ " . $file);
        if($upload_file){
            header("location:freelancerprofile mena.php");
    // echo "sample uploaded successfully";
}
 }else{
    $error_add="please put the required data";
 }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css link -->
    <link rel="stylesheet" href="./css/addproject.css">
</head>

<body>
    
    
    <div class="container">
        <div class="main">

            <!-- image div -->
            <div class="photo">
                <img class="img" src="./images/Uploading-amico.png" alt="">
            </div>
            <!-- <div class="alkol"> -->
              
                <!-- div form-->
                <div class="alform">
                    <form method="post" enctype="multipart/form-data">
                       
                        <h1 class="head">Add sample</h1>
                    

                        <!-- project name -->
                        <label>Sample Name</label>
                         <!--  -->
                        <br>
                         
                        <input type="text" name="name" id="name" value="<?php echo $name?>"  placeholder="enter the sample name" required>
                        <br>
                        <!-- description -->
                        <label class="desc">Description</label>
                        <br>
                        <textarea name="desc" id="desc" cols="50" rows="3" value="<?php echo $desc?>" placeholder="type here"></textarea>
                        <br>
                        <!-- project file -->
                        <label class="filelabel" for="file"><i class="fa-solid fa-arrow-up-from-bracket"></i> Upload
                            Your
                            Sample</label>
                        <br>
                        <input class="fileinput" type="file" name="file" id="file">
                        <br>
                          <!-- error message -->
      <div class="error">
        <a href="edit sample.php?update=<?php echo `sample_id` ?>"></a>

      
    </div>
    
                        <!-- upload button -->
                        <div class="zorar">
                            <button type="submit" href="freelancerprofile mena" name="submit">Upload</button>
                         
                           

                        </div>
                </div>
                </form>
                
            <!-- </div> -->
        </div>
    </div>


    <!-- <script src="js/addproject.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>