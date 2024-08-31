<?php
include("connection.php");
$error_msgp="";
$error_msge="";

if(isset($_POST['login'])){
    $email=$_POST['admin_email'];
    $password=$_POST['admin_password'];
    $select="SELECT * FROM `admin` WHERE `admin_email`='$email'";
    $run_select=mysqli_query($connect,$select);
    $rows=mysqli_num_rows($run_select);

    if($rows>0){
        $fetch=mysqli_fetch_assoc($run_select);
        $hashed_password=$fetch['admin_password'];
            
         if(password_verify($password,$hashed_password)){
            $admin_id=$fetch['admin_id'];
           $_SESSION['admin_id']=$admin_id;       
 
        //    header("location:malak.php");
    header("location:dash.php");


        }else{
            $error_msgp="password incorrect";
        
    }
    }else{
        $error_msge="incorrect email ";
        
        }}
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login As Admin</title>
    <!-- link google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lancelot&display=swap" rel="stylesheet">

    <!-- link font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login admin.css">
</head>

<body>

    <form class="form" method="POST">
        <h1>
            Login As Admin
        </h1>
        <span class="input-span">
            <input type="email"name="admin_email" id="email" placeholder="Enter Your E-mail" required/>
        <p>
        <?php echo $error_msge ; ?>
        </p></span>
            
            <span class="input-span">
                <input type="password"  name="admin_password" id="password" placeholder="Enter Your Password"required />
            <p>
            <?php echo $error_msgp ; ?>
            </p></span>
               
                
        <input class="submit" name="login" type="submit" value="Log in" />
    </form>




    <!-- link js bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>