<?php  
include './connection.php';
$freelancer_id=$_SESSION['freelancer_id'];
// $error_add="";
$name="";
$desc="";
//  if(isset($_POST['submit'])){
//     $file=$_FILES['file']['name'];
//     $desc=$_POST['desc'];
//     $name=$_POST['name'];
//     if(!empty($file) && !empty($desc) && !empty($name)){
//         $insert ="INSERT INTO `sample` VALUES (NULL,$freelancer_id,'$file','$desc','$name')";
//         $run_insert=mysqli_query($connect,$insert);
//         move_uploaded_file($_FILES['file']['tmp_name'],"./image/".$file);
//         $error_add="sample uploaded successfully";
//         header("refresh:2 ; url=my profile.php");
//  }else{
//     $error_add="pleas put the required data";
//  }
// }
if(isset($_GET['edit'])){
$sample_id=$_GET['edit'];
$select_samp="SELECT * FROM `sample` WHERE `sample_id`=$sample_id";
$run_samp=mysqli_query($connect,$select_samp);
$sample=mysqli_fetch_assoc($run_samp);
$desc=$sample['sample_desc'];
$name=$sample['sample_name'];
$old_file=$sample['sample_file'];
if(isset($_POST['update'])){ 
    $new_desc=$_POST['desc'];
$new_name=$_POST['name'];
$new_file=$_FILES['file']['name'];
if(!empty($new_name) && !empty($new_desc)){
    if(empty($new_file)){
        
        $update="UPDATE `sample` SET `sample_desc`= '$new_desc', `sample_name`='$new_name' WHERE `sample_id`=$sample_id";
        $run=mysqli_query($connect,$update);
        // echo "sample edit successfully";
        // header("refresh:2 ; url=freelancerprofile mena.php");
        header("location:freelancerprofile mena.php");
    }else{
        $update="UPDATE `sample` SET `sample_file`='$new_file' ,`sample_desc`= '$new_desc' , `sample_name` ='$new_name' WHERE `sample_id`=$sample_id ";
        $run=mysqli_query($connect,$update);
        move_uploaded_file($_FILES['file']['tmp_name'],"images/".$new_file);
        unlink("./images/".$old_file);
 
    //    echo "sample edit successfully";
    //     header("refresh:2 ; url=freelancerprofile mena.php");
    header("location:freelancerprofile mena.php");

    }
}else{
    echo "please put the required data";

}
}
 }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
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
                       
                        <h1 class="head">Edit project</h1>

                        <!-- project name -->
                         
                        <label>Project Name</label>
                        <br>
                        <input type="text" name="name" id="name" value="<?php echo $name?>"  placeholder="enter the project name" required>
                        <br>
                        <!-- description -->
                        <label class="desc">Description</label>
                        <br>
                        <input name="desc" id="desc" cols="50" rows="6" value="<?php echo $desc?>" placeholder="type here"></input>
                        <br>
                        <!-- project file -->
                        <label class="filelabel" for="file"><i class="fa-solid fa-arrow-up-from-bracket"></i> Upload
                            Your
                            Project</label>
                        <br>
                        <input class="fileinput" type="file" name="file" id="file">
                        <br>
                      
    
                        <!-- upload button -->
                        <div class="zorar">
                            <button type="submit" href="freelancerprofile mena" name="update">Update</button>
                            

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