<?php
include "nav.php";

// Fetch client details
$client_id = $_SESSION['client_id'];
$client = "SELECT * FROM `client` WHERE `client_id` = $client_id";
$Runclient = mysqli_query($connect, $client);
$fetch = mysqli_fetch_assoc($Runclient);
$clientname = $fetch['client_name'];
$country = $fetch['client_country'];
$client_email = $fetch['client_email'];
$image = $fetch['client_image'];

// Fetch client projects
$select_project = "SELECT * FROM `project` 
                    JOIN `type` ON `project`.`type_id` = `type`.`type_id` 
                    WHERE `client_id` = $client_id";
$run_select_project = mysqli_query($connect, $select_project);
$number_projects = mysqli_num_rows($run_select_project);

// Handle project deletion
if (isset($_POST['delete'])) {
    $id = $_POST['id']; 
    $delete = "DELETE FROM `project` WHERE `project_id` = $id";
    $run_delete = mysqli_query($connect, $delete);
    header("location:clientprofile.php");
    
}

// Handle request deletion
if (isset($_GET['delete_req'])) {
    $id = $_GET['delete_req'];
    $delete = "DELETE FROM `request` WHERE `request_id` = $id";
    $runDelete = mysqli_query($connect, $delete);
    header("location:clientprofile.php");
    
}

// Fetch requests
$select1 = "SELECT * FROM `request` 
             JOIN `freelancer` ON `request`.`freelancer_id` = `freelancer`.`freelancer_id` 
             JOIN `project` ON `project`.`project_id` = `request`.`project_id`
             WHERE `request_status` = 'approval' AND `client_id` = '$client_id'";
$runSelect1 = mysqli_query($connect, $select1);
$num_approval = mysqli_num_rows($runSelect1);

$select2 = "SELECT * FROM `request` 
             JOIN `freelancer` ON `request`.`freelancer_id` = `freelancer`.`freelancer_id` 
             JOIN `project` ON `project`.`project_id` = `request`.`project_id`
             WHERE `request_status` = 'pending' AND `client_id` = '$client_id'";
$runSelect2 = mysqli_query($connect, $select2);
$num_pending = mysqli_num_rows($runSelect2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/clinentprofile.css">
</head>
<body>

<nav class="sidebar close" id="ssideBarrr">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="../images/logo.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">Requests</span>
                </div>
            </div>

            <i class='fa-solid fa-bell ' style="font-size: 15px; color: white;" onclick="openSide()"></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <ul class="menu-req">


                    <div class="approve">
                        <span class="name" style="font-weight: 700;">Approved</span>
                    </div>
                    <?php if($num_approval>0){
                    foreach ($runSelect1 as $key){?>

                    <!-- loop here -->


                    
                    <li class="nav-link">

                        <div class="req-card">

                            <div class="req-info">

                                <h2>
                                    <a href="viewprofile.php?view_profile=<?php echo $key ['freelancer_id'] ?>"><?php echo  $key['freelancer_name'];?></a>
                                
                                </h2>

                                <h4>
                                <?php echo " accepted your request on ".    $key['project_name'];?>
                                </h4>

                            </div>
                            <?php 
                            $request_id=$key['request_id'];
                             $select_payment= "SELECT * FROM `payment` where `request_id`=$request_id";
                            $run_payment=mysqli_query($connect ,$select_payment);
                            $number_payment=mysqli_num_rows($run_payment);

                             if($number_payment==0)   { ?>                       
                                <div class="req-btn">

                                    <a class="req-a" href="payment.php?pay=<?php echo $key['request_id']?>"> Pay</a>


                                </div>

                        </div>

                    </li>
                
                    <?php }  ?>
              <?php } }else{?>
                        <div class="approve">
                            <span class="name" style="font-weight: 700;">No requests approved yet</span>
                        </div>
                    <?php } ?>
                    <!-- end here -->


                </ul>

                <br>

                <hr>
                <br>


                <ul class="menu-req">


                    <div class="approve">
                        <span class="name" style="font-weight: 700;">Pending</span>
                    </div>


                    <!-- loop here -->

                    <?php if($num_pending>0){
                    foreach ($runSelect2 as $key){?>
                    
                    <li class="nav-link">

                        <div class="req-card">

                            <div class="req-info">

                            <h4>
                                <?php echo "<br> your request on ".    $key['project_name'];?>
                            </h4>
                            
                            <h4>
                                    <?php echo "is still pending to ". $key['freelancer_name'];?>
                         
                                </h4>

                            </div>

                            <div class="req-btn">

                                <a class="req-a" href="clientprofile.php?delete_req=<?php echo $key['request_id']?>"> cancel</a>


                            </div>

                        </div>

                    </li>
                
                    <?php } }else{?>
                        <div class="approve">
                        <span class="name" style="font-weight: 700;">No requests pending yet</span>
                    </div>
<?php } ?>
                    <!-- end here -->


                </ul>



            </div>


        </div>

    </nav>

<div class="home">
    <div class="main">
        <div class="main-first">
            <div class="info">
                <div class="img">
                    <img src="./images/<?php echo $image; ?>" alt="">
                </div>
                <h3><?php echo $clientname ?></h3>
                <p><?php echo $country ?></p>
            </div>
        </div>

        <div class="main-sec">
            <div class="information">
                <p>Full Name: <?php echo $clientname ?></p>
                <p>Email: <?php echo $client_email ?></p>
                <a class="update" href="edit_profile_client.php">
                    <i class="fa-regular fa-pen-to-square"></i>
                </a>
                <div class="change">
                    <a href="changepass_client.php" class="add2">Change Password <i class="fa-solid fa-pen"></i></a>
                </div>
            </div>

            <div class="upload">
                <a href="client_add_project.php" class="add">ADD Project <i class="fa-solid fa-plus fa-bounce"></i></a>
                <div class="main-sample">
                    <?php if ($number_projects > 0) {
                        foreach ($run_select_project as $data) { ?>
                            <div class="sample">
                                <div class="info">
                                    <h3><?php echo $data['project_name'] ?></h3>
                                    <p><?php echo $data['project_desc'] ?></p>
                                </div>
                                <div class="big-btns">
                                    <div class="mini-btns">
                                        <a href="task-details.php?id=<?php echo $data['project_id']?>">View Details</a>
                                        <a id="edit" href="edit_project.php?edit=<?php echo $data['project_id']?>">Edit <i class="fa-regular fa-pen-to-square" style="color: blue;"></i></a>
                                        <a type="button" onclick="showPopup(<?php echo $data['project_id'] ?>)">Delete <i class="fa-solid fa-trash" style="color: #d81313;"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php } 
                    } else { ?>
                        <h2>No projects yet</h2>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete confirmation popup -->
<div class="container-save d-none" id="unsave">
    <form action="" method="POST" id="deleteForm">
        <div class="cookiesContent" id="cookiesPopup">
            <button class="close" type="button" onclick="closePopup()">✖</button>
            <img src="./images/trash.jpg" alt="cookies-img" />
            <p>Are you sure you want to delete this project?</p>
            <input type="hidden" name="id" id="projectId">
            <button class="accept" name="delete" type="submit">Yes</button>
        </div>
    </form>
</div>







<script>
    const popup = document.getElementById("unsave");
    const projectIdInput = document.getElementById("projectId");
    const deleteForm = document.getElementById("deleteForm");

    function showPopup(projectId) {
        popup.classList.remove('d-none');
        projectIdInput.value = projectId;
    }

    function closePopup() {
        popup.classList.add("d-none");


        
    }

</script>

<script>

    var sidebar = document.getElementById("ssideBarrr")

    function openSide(){
        sidebar.classList.toggle("close");
    }
   
</script>



   

</body>
</html>
