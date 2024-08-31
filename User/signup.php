<?php
$emailc="" ;
$passwordc=""  ;
$matchc="" ;
$emailf="" ;
$passwordf=""  ;
$matchf="" ;
$name="";
$email="";
$nationalId="";
$country="country";
$category="";
$catN="Category";
$idf="";
$error_msg="";
$error_msgf="";

$error=FALSE;

$errF=FALSE;

include("mail.php");
$form = isset($_POST['form_action']) ? $_POST['form_action'] : 'sign_up';

$cat="SELECT * FROM `category`";
$run_cat=mysqli_query($connect,$cat);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $form=$_POST['form_action'];

    if($form=='sign_up' && isset($_POST['submit'])){

// if(isset($_POST['submit'])){  

    $name=$_POST['client_name'];
    $email=$_POST['client_email'];
    $password=$_POST['client_password'];
    $confirm_pass=$_POST['confirm_pass'];
    // $country=$_POST['country'];
    $country=isset($_POST['country'])?$_POST['country']:null;

    $passwordhashing=password_hash($password , PASSWORD_DEFAULT);
    $lowercase=preg_match('@[a-z]@',$password);
    $uppercase=preg_match('@[A-Z]@',$password);
    $numbers=preg_match('@[0-9]@',$password); 

    $select="SELECT * FROM `client` WHERE `client_email` ='$email' ";
    $run_select=mysqli_query($connect,$select);
    $rows=mysqli_num_rows($run_select);
    if(empty($name) || empty($email) || empty($password) || empty($confirm_pass) || empty($country)){
        // echo 5555;

      $error_msg= " please fill all required data ";
      $error=TRUE;
    
    
    }elseif($rows>0){
    
// var_dump($rows);
        $emailc= "this email is already taken";
      $error=TRUE;
    }elseif($lowercase<1 || $uppercase <1||$numbers<1){
        $passwordc="password must contain at least 1 uppercase , 1 lowercase and number";
      $error=TRUE;
    

        
    }elseif($password !=$confirm_pass){
    

       $matchc= "password doesn't match confirmed password";
      $error=TRUE;
    

    }else{
        
        $_SESSION['user_name']=$name;
        $_SESSION['user_email']=$email;
        $_SESSION['password']=$passwordhashing;
            $rand=rand(10000,99999);
            $msg="hello,your otp is $rand";
                        // php mail start->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            $mail->setFrom('maloka.elhalawany@gmail.com', 'Tawarod');          //sender mail address , website name
            $mail->addAddress($email);      //reciever mail address
            $mail->isHTML(true);                               
            $mail->Subject = 'Activation code';             //mail subject
            $mail->Body=($msg);                  //mail content
            $mail->send(); 
                   //php mail end ->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
                   $_SESSION['otp']=$rand;
                   $_SESSION['time']=time();

            header("location:signup_client_otp.php");
            
    // $insert="INSERT INTO `client` VALUES(NULL,'$name','$email','$passwordhashing','$country','default')";
    // $run_insert=mysqli_query($connect,$insert);
    $_SESSION['name']=$name;
    $_SESSION['password']=$passwordhashing;
    $_SESSION['email']=$email;
    $_SESSION['country']= $country;
    echo "data added succesfully";
    
     
    }
}elseif ($form == 'sign_upF' && isset($_POST['submit1'])){

    
########################################################################################
// freelancer sign-up
// if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // $form=$_POST['form_action'];
    // if($form=='sign_upF'){

// if(isset($_POST['submit1'])){  


    $name=$_POST['freelancer_name'];
    $email=$_POST['freelancer_email'];
    $password=$_POST['freelancer_password'];
    $confirm_pass=$_POST['confirm_pass'];
    // $category=$_POST['category'];
    $category=isset($_POST['category'])?$_POST['category']:null;
    if($category!=NULL){
    $c="SELECT * FROM `category` WHERE `cat_id` =  '$category'";
    $runc=mysqli_query($connect,$c);
    $fettt=mysqli_fetch_Assoc($runc);
    $catN=$fettt['cat_name'];
    }

    $nationalId = $_POST['N_ID'];
    $birthDate = $_POST['birthday'];



    // $N_ID=$_POST["N_ID"];
    // $birthday=$_POST["birthday"];
    $passwordhashing=password_hash($password , PASSWORD_DEFAULT);
    $lowercase=preg_match('@[a-z]@',$password);
    $uppercase=preg_match('@[A-Z]@',$password);
    $numbers=preg_match('@[0-9]@',$password);
    $select1="SELECT * FROM `freelancer` WHERE `freelancer_email` ='$email' ";
    $run_select1=mysqli_query($connect,$select1);
    $rows=mysqli_num_rows($run_select1);
    function IDvalidation($nationalId, $birthDate) {
        if (strlen($nationalId) != 14 || !ctype_digit($nationalId)) {
            return false;
        }
        $century = substr($nationalId, 0, 1);
        $year = substr($nationalId, 1, 2);
        $month = substr($nationalId, 3, 2);
        $day = substr($nationalId, 5, 2);
        if ($century != '2' && $century != '3') {
            return false;
        }
        $fullYear = ($century == '2') ? '19' . $year : '20' . $year;
    
        if (!checkdate($month, $day, $fullYear)) {
            return false;
        }
        $extractedDate = "$fullYear-$month-$day";
        return $extractedDate === $birthDate;
    }
    
    
 
    
    if(empty($name)||empty($email)||empty($password)||empty($confirm_pass)||empty($nationalId)){
      $error_msgf= " please fill all required data ";
      $errF=TRUE;
    
    }elseif($rows>0){
      $emailf= "this email is already taken";
      $errF=TRUE;
    }elseif($lowercase<1 || $uppercase <1||$numbers<1){
      $passwordf= "password must contain at least 1 uppercase , 1 lowercase and number";
      $errF=TRUE;
    }elseif($password !=$confirm_pass){
        $matchf= "password doesn't match confirmed password";
        $errF=TRUE;


    }elseif (IDvalidation($nationalId, $birthDate)) {
        
        $_SESSION['user_name']=$name;
        $_SESSION['user_email']=$email;
        $_SESSION['password']=$passwordhashing;
        $_SESSION['nationalId']=$nationalId;
            $rand=rand(10000,100000);
            $msg="hello,your otp is $rand";
                        // php mail start->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            $mail->setFrom('maloka.elhalawany@gmail.com', 'Tawarod');          //sender mail address , website name
            $mail->addAddress($email);      //reciever mail address
            $mail->isHTML(true);                               
            $mail->Subject = 'Activation code';             //mail subject
            $mail->Body=($msg);                  //mail content
            $mail->send(); 
            $_SESSION['time']=time();
                   //php mail end ->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
                   $_SESSION['otp']=$rand;
            header("location:signup_freelancer_otp.php");
            // E7NA 3AMLYN FE EL DATA BASE CAT ID NULL
    // $insert="INSERT INTO `freelancer` VALUES(NULL,'$name','$email','$passwordhashing','default','default','$N_ID','$birthday',NULL,'default','default','default','default','default')";

    // $run_insert=mysqli_query($connect,$insert);
    $_SESSION['name']=$name;
    $_SESSION['password']=$passwordhashing;
    $_SESSION['email']=$email;
    $_SESSION['nationalId']=$nationalId;
    $_SESSION['birthDate']=$birthDate;
    $_SESSION['category']=$category;
    echo "data added succesfully";
     
} else {
   $idf= "The national ID does not match the birth date or is invalid.";
   $errF=TRUE;
   

    
}
} } 


?>


<!DOCTYPE html>
<html lang="en">

<head>



    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">





    <link rel="stylesheet" href="./css/signup.css">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-user">
            <!-- ------------------client signup------------------ -->
            <form action="" method="POST">
                <h1>Create Account</h1>
                <span>Create A Client Account</span>
                <input type="hidden" placeholder="form_action" name="form_action" value="sign_up">

                <input type="text" placeholder="Name" name="client_name" value="<?php echo $name?>">
                <input type="email" placeholder="Email" name="client_email"value="<?php echo $email?>">
                 <div class=error2><?php echo $emailc?></div>
                 <input type="password" placeholder="Password" name="client_password">
                <div class=error2> <?php  echo$passwordc  ?>  </div>
                <input type="password" placeholder="Confirm Password" name="confirm_pass">
                <div class=error2>   <?php echo $matchc ?> </div>

                
                <select name="country" id="country" >
                    <option disabled hidden selected><?php echo $country?></option>
                    <option value="Egypt">Egypt</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Iran">Iran</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="Palestine">Palestine</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="the Syrian Arab Republic">The Syrian Arab Republic</option>
                    <option value="Comoros Islands">Comoros Islands</option>
                    <option value="the United Arab Emirates">The United Arab Emirates</option>
                    <option value="Oman">Oman</option>
                    <option value="Libya">Libya</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Algeria">Algeria</option>
                    <option value="Mauritania">Mauritania</option>
                </select>
                 
                <div class="error"> <?php if ($error){ ?> 
            
               <?php echo $error_msg ; }?> </div>
              <a href="login.php" class="login"> already have an account? login</a>
                <button type="submit" name="submit">Sign Up</button>
            </form>
            <!-- ----------------------end client signup---------------------- -->
        </div>



        <div class="form-container sign-up-freelancer">
            <form action="" method="POST">
                <!-- -------------------freelancer signup----------------- -->
                <h1>Create Account</h1>
                <span>Create A Freelancer Account</span>
                <input type="hidden" placeholder="form_action" name="form_action" value="sign_upF">


                <input type="text" placeholder="Name" name="freelancer_name"value="<?php echo $name?>">
                <input type="email" placeholder="Email" name="freelancer_email"value="<?php echo $email?>">
                 <div class=error2><?php echo $emailf?> </div>
                <input type="password" placeholder="Password" name="freelancer_password">
                <div class=error2><?php echo $passwordf ?> </div>
                <input type="password" placeholder="Confirm Password" name="confirm_pass">
                 <div class=error2> <?php echo $matchf ?></div>
                <input type="number" placeholder="National ID" name="N_ID"value="<?php echo $nationalId?>">
                 <div class=error2><?php echo $idf ?> </div>
                <input type="date" placeholder="Birth Date" name="birthday">
                <select name="category" id="category" >
                    <option disabled hidden selected ><?php echo $catN?></option>
                   
                    <?php foreach ($run_cat as $value){ ?>
                    <option value="<?php echo $value['cat_id'] ?>"><?php echo $value['cat_name'] ?></option> 
                        <?php } ?>
                    </select>

                <div class="error"><?php if ($errF){
                 echo $error_msgf; 
            } ?></div>
                <a href="login.php" class="login"> already have an account? login</a>
                <button type="submit" name="submit1">Sign Up</button>
            </form>
            <!-- ---------------------end freelancer signup--------------------- -->
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Hello, Friend!<br> Sign Up As Client</h1>
                    <p>Register with your personal details <br> to use all of site features</p>
                    <button id="register" class="hidden">Sign Up</button>
                </div>
                <div class="toggle">
                    <div class="toggle-panel toggle-right">
                        <h1>Hello, Friend! <br> Sign Up As Freelancer</h1>
                        <p>Register with your personal details <br> to use all of site features</p>
                        <button class="hidden" id="signup">Sign Up</button>
                    </div>



                </div>
            </div>
        </div>

    </div>




</body>

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

</html>