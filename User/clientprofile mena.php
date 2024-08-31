<?php
include "connection.php";
$client_id=$_SESSION['client_id'];
$select1="SELECT * FROM `request` JOIN `freelancer` ON `request`.`freelancer_id`= `freelancer`.`freelancer_id` 
JOIN `project` ON `project`.`project_id`= `request`.`project_id`
WHERE `request_status`='approval' AND `client_id`= '$client_id'";
$runSelect1=mysqli_query($connect,$select1);
$num_approval=mysqli_num_rows($runSelect1);
$select2="SELECT * FROM `request` JOIN `freelancer` ON `request`.`freelancer_id`= `freelancer`.`freelancer_id` 
JOIN `project` ON `project`.`project_id`= `request`.`project_id`
WHERE `request_status`='pending' AND `client_id`='$client_id'";
$runSelect2=mysqli_query($connect,$select2);
$num_pending=mysqli_num_rows($runSelect2);
//  $fetch=mysqli_fetch_assoc($runSelect2);
//  $request_status=$fetch['request_status'];
$fetch = mysqli_fetch_assoc($run_select);
$cat_id=$fetch['cat_id'];
$subCat=$fetch['subcat_id'];
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $delete="DELETE FROM `request` WHERE `request_id`=$id";
    $runDelete=mysqli_query($connect,$delete);
    header("location:sideNav.php");
}




?>


<!DOCTYPE html>
<html lang="en">

<head>



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">





    <link rel="stylesheet" href="./css/clinentprofile.css">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> client profile</title>
</head>

<body>

    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="../images/logo.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">Requests</span>
                </div>
            </div>

            <i class='fa-solid fa-bell toggle' style="font-size: 15px; color: white;"></i>
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
                                <?php echo  $key['freelancer_name'];?>
                                </h2>

                                <h4>
                                <?php echo " accepted your request on ".    $key['project_name'];?>
                                </h4>

                            </div>

                            <div class="req-btn">

                                <a class="req-a" href="sideNav.php?pay=<?php echo $key['request_id']?>"> Pay</a>


                            </div>

                        </div>

                    </li>
                
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

                                <a class="req-a" href="sideNav.php?delete=<?php echo $key['request_id']?>"> cancel</a>


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
                        <img src="../images/user1.png" alt="">
                    </div>
                    <h3>
                        Yassin
                    </h3>

                    

                    <!-- <div class="rev-icon">
                        <span>
                            <a href="#">

                                <i class="fa-solid fa-star" style="color: black;"></i>

                            </a>
                        </span>
                    </div> -->

                </div>

                <div class="links">

                    <h1>
                        Links
                    </h1>

                    <a href=""> <i class="fa-brands fa-facebook"></i> Facebook</a>

                    <a href=""> <i class="fa-brands fa-whatsapp" style="color: green;"></i> Whatsapp</a>

                    <a href=""> <i class="fa-brands fa-instagram" style="color: purple;"></i> Instgram</a>

                    <a href=""> <i class="fa-brands fa-linkedin"></i>LinkdIn</a>

                </div>

            </div>




            <div class="main-sec">


                <div class="information">

                    <p>Full Name : yassin </p>
                    <p>Email : yassin@gmail.com </p>
                    

                    <a class="update">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>

                    <div class="change">

                        <a href="" class="add2">Change Password<span> <i class="fa-solid fa-pen"></i></span></a>

                    </div>


                </div>

                

                <div class="upload">

                    <a href="" class="add"> ADD Project <span> <i class="fa-solid fa-plus fa-bounce"></i></span></a>


                    <div class="main-sample">




                        <!-- start here -->



                        <div class="sample">

                            <div class="info">

                                <h3>Project Name </h3>

                                <p>Project description</p>

                            </div>

                            <div class="big-btns">

                                <div class="mini-btns">
                                    <a href="">Edit <i class="fa-regular fa-pen-to-square" style="color: blue;"></i></a>
                                    <a href="">Delete <i class="fa-solid fa-trash" style="color: red;"></i></a>
                                </div>


                            </div>
                        </div>



                        <!-- end loop here -->

                    </div>




                </div>

            </div>

        </div>

        <div class="reviews">

        </div>

    </div>


    <script>
        const body = document.querySelector('body'),
            sidebar = body.querySelector('nav'),
            toggle = body.querySelector(".toggle"),
            searchBtn = body.querySelector(".search-box"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text");
        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        })
        searchBtn.addEventListener("click", () => {
            sidebar.classList.remove("close");
        })
        modeSwitch.addEventListener("click", () => {
            body.classList.toggle("dark");
            if (body.classList.contains("dark")) {
                modeText.innerText = "Light mode";
            } else {
                modeText.innerText = "Dark mode";
            }
        });
    </script>


</body>

</html>