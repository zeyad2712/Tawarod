<?php
include('nav.php');
$dm="";
$old="";
$err=FALSE;
// include("navbar.php");
$freelancer_id=$_SESSION['freelancer_id'];
if(isset($_POST['submit'])){
    $select="SELECT * FROM `freelancer` WHERE `freelancer_id`='$freelancer_id'";
    $run=mysqli_query($connect,$select);
    $fetch=mysqli_fetch_assoc($run);
   $fetchold=$fetch['freelancer_password'];
    $old_pass=$_POST['old_password'];
    $new_pass=$_POST['new_password'];
    $confirm_pass=$_POST['confirm_password'];
    if(password_verify($old_pass,$fetchold)){
        if($new_pass==$confirm_pass){
            $new_hashing= password_hash($new_pass, PASSWORD_DEFAULT);
            $update="UPDATE `freelancer` set `freelancer_password`='$new_hashing' WHERE `freelancer_id`='$freelancer_id'";
            $run_update=mysqli_query($connect,$update);
            echo "Password is changed successfully!";
            header("location:freelancerprofile mena.php?edit=$freelancer_id");

        }else{
            $dm= "The new password doesn't match the confirmed one";
            $err=TRUE;
        }
    }else{
        $old= "Old password is incorrect";
        $err=TRUE;
    }

}   


?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ----------------------------------bootstrap link-------------------------------------  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- --------------------------------google font--------------------------- -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- ---------------------------font awesome-------------------------------- -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- -----------------------------css link------------------------------------- -->
    <link rel="stylesheet" href="./css/changepass.css">
    <title>Document</title>
</head>

<body>
    <!-- ---------------------------error area---------------------------- -->

    <!-- ------------------------------error area end-------------------- -->
    <div class="home-section">






        <div class="main-form">
            <div class="sub-form">

                <h1>Change Password</h1>

                <form action="" class="mini-form" method="POST">


                    <!-- old pass -->
                    <div class="eye">
                        <i class="fa-solid fa-eye" style="color: white;"></i>
                    </div>

                    <input type="password" id="old" name="old_password" placeholder="Enter Your Old Password . ." class="pass"><br>



                    <!-- new pass -->
                    <div class="eye">
                        <i class="fa-solid fa-eye" style="color: white;"></i>
                    </div>


                    <input type="password" id="new" name="new_password" placeholder="Enter Your New Password" class="pass"><br>

                    <!-- confirm new pass -->

                    <div class="eye ">
                        <i class="fa-solid fa-eye" style="color: white;"></i>
                    </div>


                    <input type="password"name="confirm_password" id="cnew" placeholder="Confirm New . ." class="pass"><br>

                    <!-- -----------------------error------------------------------- -->
                    <div class="error">
                    <?php if($err){ ?> <p>error</p>
                        <?php echo $dm; echo $old; } ?>
                    </div>
                    <!-- -------------------------error------------------------------ -->
                    <div class="bttn">

                        <button type="submit" class="Change-btn" name ="submit">Change</button>


                    </div>





                </form>
            </div>
        </div>


        <div class="pic">
            <img src="./images/Reset password-cuate (1).png" height="500px" width="500px">
        </div>



    </div>

    <!-- ----------------------------------------bootstrap link---------------------------------- -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

<script src="./js/changepass.js"></script>


</html> 