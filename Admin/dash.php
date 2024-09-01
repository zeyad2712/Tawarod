<?php 
include("connection.php");
$admin= $_SESSION['admin_id'];
$er_email="";
$er_pass="";
$er_pass1="";
$error_msg="";
$sel_ad="SELECT * FROM `admin` WHERE `admin_id`=$admin";
$run_ad=mysqli_query($connect , $sel_ad);
$fetch=mysqli_fetch_assoc($run_ad);
$ad_name=$fetch['admin_name'];
$select_free="SELECT COUNT(*) AS total FROM `freelancer`  ";
$run_free=mysqli_query($connect,$select_free);
$fetch =mysqli_fetch_assoc($run_free);
$total_freelancers=$fetch['total'];
$sel_admin="SELECT * FROM `admin`";
$run_admin=mysqli_query($connect , $sel_admin);

$select_client="SELECT COUNT(*) AS totalc FROM `client`  ";
$run_client=mysqli_query($connect,$select_client);
$fetch =mysqli_fetch_assoc($run_client);
$total_client=$fetch['totalc'];


$select_reports="SELECT COUNT(*) AS reports FROM `reports`  ";
$run_reports=mysqli_query($connect,$select_reports);
$fetch =mysqli_fetch_assoc($run_reports);
$total_reports=$fetch['reports'];

$nom=1;

$nom1=1;

$select_project="SELECT COUNT(*) AS projects FROM `payment`  ";
$run_project=mysqli_query($connect,$select_project);
$fetch =mysqli_fetch_assoc($run_project);
$total_projects=$fetch['projects']; 

$select_client="SELECT * FROM `reports` left JOIN `client` ON `client`.`client_id`=`reports`.`client_id`
  left JOIN `freelancer` ON  `freelancer`.`freelancer_id` = `reports` . `freeelancer_id`";
$run_select=mysqli_query($connect , $select_client);
if(isset($_POST['submit'])){  
    $name=$_POST['admin_name'];
    $email=$_POST['admin_email'];
    $password=$_POST['admin_password'];
    $confirm_pass=$_POST['confirm_pass'];
    $passwordhashing=password_hash($password , PASSWORD_DEFAULT);
    $lowercase=preg_match('@[a-z]@',$password);
    $uppercase=preg_match('@[A-Z]@',$password);
    $numbers=preg_match('@[0-9]@',$password);
    $select="SELECT * FROM `admin` WHERE `admin_email` ='$email' ";
    $run_select=mysqli_query($connect,$select);
    $rows=mysqli_num_rows($run_select);
    if(empty($name)||empty($email)||empty($password)||empty($comfirm_pass)){
      $error_msg= " please fill all required data ";
    
    }if($rows>0){
        $er_email="this email is already taken";
    }elseif($lowercase<1 || $uppercase <1||$numbers<1){
        $er_pass="password must contain at least 1 uppercase , 1 lowercase and number";
    }elseif($password !=$confirm_pass){
        $er_pass1="password doesn't match confirmed password";
    }else{
    
    $insert="INSERT INTO `admin` VALUES(NULL,'$name','$email','$passwordhashing')";
    $run_insert=mysqli_query($connect,$insert);
    echo "data added succesfully";
     
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Interface</title>
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

    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>

<div class="sidebar">

<div class="heading">
    <h5>
        welcome <?php echo $ad_name ?>
    </h5>
</div>

<div class="list">
    <ul>
        <li>
            <a href="#" onclick="closeRep()">Dashboard</a>
        </li>
        <li>
            <a href="#" onclick="openRep()">Reports</a>
        </li>
        <li>
            <a href="#" onclick="openAdm()">Admins</a>
        </li>
        <li>
            <a href="#" onclick="openAdd()">Add Admin</a>
        </li>

    </ul>
</div>



<div class="log">
    <form method="POST">
    <button name="logout">
        Logout
    </button>
</form>
</div>

</div>

    <div class="main-content  " id="main-content">

        <div class="main-heading">
            <h1>
                Admin Interface
            </h1>
        </div>

        <div class="dash">

            <div class="dash-heading">
                <h1>
                    Dashboard
                </h1>
            </div>

            <div class="card-holder">

                <div class="card1">
                    <div class="icon">
                        <h1>
                            <i class="fa-solid fa-list-check"></i>
                        </h1>
                    </div>
                    <div class="stilte">
                        <h4>
                            
                            <?php echo $total_projects ?>
                        </h4>
                        <p>Projects</p>
                    </div>
                </div>
                <div class="card1">
                    <div class="icon">
                        <h1>
                            <i class="fa-solid fa-scroll"></i>
                        </h1>
                    </div>
                    <div class="stilte">
                        <h4>
            <?php  echo $total_reports ?>
                            
                        </h4>
                        <p>No. Of Reports</p>
                    </div>
                </div>
                <div class="card1">
                    <div class="icon">
                        <h1>
                            <i class="fa-solid fa-user"></i>
                        </h1>
                    </div>
                    <div class="stilte">
                        <h4>
                            <?php echo $total_freelancers ?>
                        </h4>
                        <p>No. Of Freelancers</p>
                    </div>
                </div>
                <div class="card1">
                    <div class="icon">
                        <h1>
                            <i class="fa-solid fa-people-group"></i>
                        </h1>
                    </div>
                    <div class="stilte">
                        <h4>
                            <?php echo $total_client ?>

                        </h4>
                        <p>No. Of Clients</p>
                    </div>
                </div>
            </div>


        </div>

        
    </div>


    <div class="main-content1 d-none"  id="main-content1">

        <div class="main-heading">
            <h1>
                Reports Table
            </h1>
        </div>

        <div class="table-reports">

            
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Client E-mail</th>
                        <th scope="col">Report</th>
                        <th scope="col">Freelancer Name</th>
                        <th scope="col">Freelancer National ID</th>
                        <th scope="col">Freelancer E-mail</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php foreach($run_select as $data ) {?>
                    
                        <th scope="row"><?php echo $nom++?></th>

                        <td><?php echo $data['client_name'];?> </td>

                        <td><a href="mailto:<?php echo $data['client_email'];?>"><?php echo $data['client_email'];?></a></td>
                        <td><?php echo $data['report']; ?>  </td>   
        <td><?php echo $data['freelancer_name'];?>  </td>   
        <td><?php echo $data['N_id'];?>  </td>   
        <td><a href="mailto:<?php echo $data['freelancer_email'];?>"> <?php echo $data['freelancer_email'];?></a></td>   
        
    </tr>
    <?php } ?>
                    
                    
                </tbody>
            </table>
        </div>


    </div>


    <div class="main-content2 d-none" id="main-content2">


        <div class="add-admin">
            <form class="form" method="POST">
                <h1>
                    Add New Admin
                </h1>
                <span class="input-span">
                    <input type="text" name="admin_name"  id="text" placeholder="Enter admin Name"required /></span>
                <span class="input-span">
                    <input type="email"  name="admin_email" id="email" placeholder="Enter admin E-mail"required />
                    <p>  <?php echo $er_email ?>           </p>
               </span>

                <span class="input-span">
                    <input type="password" name="admin_password" id="password" placeholder="Enter admin Password" required/></span>
                     <span class="input-span">
                    <input type="password" name="confirm_pass" id="password" placeholder="Confirm admin Password" required /></span>
                   
                <input class="submit" name="submit" type="submit" value="Add" />
                
            </form>
        </div>


    </div>


    <div class="main-content3 d-none" id="main-content3">

        <div class="main-heading">
            <h1>
                Admins 
            </h1>
        </div>

        <div class="table-reports">


            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Admin Name</th>
                        <th scope="col">Admin E-mail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                <?php foreach($run_admin as $data ) {?>
                        <th scope="row"><?php echo $nom1++?></th>
                        <td><?php echo $data['admin_name'] ?> </td>
                        <td><?php echo $data['admin_email'] ?> </td>
                    </tr>
    <?php } ?>

                </tbody>
            </table>
        </div>



    </div>





    <script>
        var maincontent = document.getElementById("main-content");
        var maincontent1 = document.getElementById("main-content1");
        var maincontent2 = document.getElementById("main-content2");
        var maincontent3 = document.getElementById("main-content3");

        function openRep() {
            maincontent.classList.add('d-none')
            maincontent1.classList.remove('d-none')
            maincontent2.classList.add('d-none')
            maincontent3.classList.add('d-none')
        }

        function closeRep() {
            maincontent.classList.remove('d-none')
            maincontent1.classList.add('d-none')
            maincontent2.classList.add('d-none')
            maincontent3.classList.add('d-none')
        }

        function openAdd() {
            maincontent.classList.add('d-none')
            maincontent1.classList.add('d-none')
            maincontent2.classList.remove('d-none')
            maincontent3.classList.add('d-none')
        }

        function openAdm() {
            maincontent.classList.add('d-none')
            maincontent1.classList.add('d-none')
            maincontent2.classList.add('d-none')
            maincontent3.classList.remove('d-none')
        }
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


</body>

</html>
