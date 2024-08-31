<?php
include("connection.php");
$error_msgp="";
$error_msge="";
$error_msgfe="";
$error_msgf="";
$form = isset($_POST['form_action']) ? $_POST['form_action'] : 'sign_up';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $form=$_POST['form_action'];
if(isset($_POST['login1'])){
    $email=mysqli_real_escape_string($connect,$_POST['freelanceremail']);
    $password=mysqli_real_escape_string($connect,$_POST['freelancerpassword']);
    $select="SELECT * FROM `freelancer` WHERE `freelancer_email`='$email'";
    $run_select=mysqli_query($connect,$select);
    $rows=mysqli_num_rows($run_select);

    if($rows>0){
        $fetch=mysqli_fetch_assoc($run_select);
        $hashed_password=$fetch['freelancer_password'];
            
         if(password_verify($password,$hashed_password)){
            $freelancer_id=$fetch['freelancer_id'];
           $_SESSION['freelancer_id']=$freelancer_id;       
    //change header!!!
           header("location:homee.php");
        //    echo "data";
        }else{
            $error_msgp="password incorrect";
           
    }
    }else{
        $error_msge="incorrect email ";
        }
    }elseif(isset($_POST['login2'])){
    
// header("location:dashboard.php");

      $email=mysqli_real_escape_string($connect,$_POST['clientemail']);

      $password=mysqli_real_escape_string($connect,$_POST['clientpassword']);
    
    $select="SELECT * FROM `client` WHERE `client_email`='$email'";
    $run_select=mysqli_query($connect,$select);
    $rows=mysqli_num_rows($run_select);

    if($rows>0){
        $fetch=mysqli_fetch_assoc($run_select);
        $hashed_password=$fetch['client_password'];
            
         if(password_verify($password,$hashed_password)){
            $client_id=$fetch['client_id'];
            $_SESSION['client_id']=$client_id;
            //change header!!!
            //    echo "data";
               header('location:homee.php');
            // header("location:forget_pass.php");
        }else{
            $error_msgf="password incorrect";
          
    }
    }else{
        $error_msgfe="incorrect email ";
   }
}
}  
//  header("location:connection.php");
    
    ?>


   
    
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>


    <link rel="stylesheet" href="./css/login.css">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    <div class="container" id="container">
        <!-- User Login -->
        <div class="form-container sign-up-user">
            <form class="user" action="" method="post" >
                <h1>Login</h1>
                <span>As Client</span>
                <input type="hidden" placeholder="form_action" name="form_action" value="sign_up">

                <!-- E-mail Input -->
                <input type="email" placeholder="Email" required name="clientemail">
                <!-- Password Input -->
                <input type="password" placeholder="Password" required name="clientpassword">
                <?php echo $error_msgfe.$error_msgf ?>
                <!-- Error -->
                <div class="error"></div>
                <!-- Forget Link -->
                <div class="pass-link">
                    <a class="forget" href="forgetpass_client.php">Forgot password?</a>
                </div>
                <!-- Login BTN -->
                <button  name="login2">Login</button>
                <!-- sign up Link -->
                <div class="signup-link">
                    <a class="signup" href="signup.php">Signup now?</a>
                </div>
            </form>
        </div>
    </body>
    <body>
        <!-- Freelancer Login -->
        <div class="form-container sign-up-freelancer">
            <form class="free" action="" method="post">
                <h1> Login </h1>
                <span>As Freelancer</span>
                <input type="hidden" placeholder="form_action" name="form_action" value="sign_upF">

                <!-- E-mail Input -->
                <input type="email" placeholder="Email" required name="freelanceremail" >
                <!-- Password Input -->
                <input type="password" placeholder="Password" required name="freelancerpassword" >
                <?php echo $error_msgp.$error_msge ?>
                <!-- Error -->
                <!-- <div class="error">the E-mail or password is incorrect!</div> -->
                <!-- Forget Link -->
                <div class="pass-link">
                    <a class="forget" href="forgetpass_freelancer.php">Forgot password?</a>
                </div>
                <!-- Login BTN -->
                <button name="login1">Login</button>
                <!-- sign up Link -->
                <div class="signup-link">
                    <a class="signup" href="signup.php">Signup now?</a>
                </div>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Login As Client</h1>
                
                    <button id="register" class="hidden">Login</button>
                </div>
                <div class="toggle">
                    <div class="toggle-panel toggle-right">
                        <h1>Login As Freelancer</h1>
                        <button class="hidden" id="signup">Login</button>
                    </div>
                </div>
            </div>
        </div>

    </div>




</body>
<!-- <script src="./js/login.js"> -->
<script>

    document.addEventListener('DOMContentLoaded', function () {
    var formAction = "<?php echo $form; ?>";
    const container = document.getElementById('container');

    if (formAction === 'sign_upF') {
        container.classList.add('active');
    } else {
        container.classList.remove('active');
    }
});

const registerBtn = document.getElementById('register');
const signUpBtn = document.getElementById('signup');

signUpBtn.addEventListener('click', () => {
    document.querySelector('input[name="form_action"]').value = 'sign_upF';
    container.classList.add("active");
});

registerBtn.addEventListener('click', () => {
    document.querySelector('input[name="form_action"]').value = 'sign_up';
    container.classList.remove("active");
});

        // Retain the form state on form submission
        document.querySelector('form').addEventListener('submit', function (event) {
        var form = event.target;
        var formAction = form.querySelector('#form_action').value;
        localStorage.setItem('formAction', formAction);
    });

    window.addEventListener('load', function () {
        var storedFormAction = localStorage.getItem('formAction');
        if (storedFormAction) {
            toggleForms(storedFormAction);
            localStorage.removeItem('formAction');
        }
    });

</script>



</script>

</html>