<?php
include "nav.php";

// Fetch client details
// $client_id = $_SESSION['client_id'];
if(isset($_GET['view'])){
    $client_id= $_GET['view'];
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
$select_filter = "SELECT * FROM `posts`  JOIN `project` ON `project`.`project_id` = `posts`.`project_id`
JOIN `category` ON `posts`.`cat_id` = `category`.`cat_id`
JOIN `client` ON `client`.`client_id` = `project`.`client_id`

                  WHERE project.client_id = '$client_id' ";
$filtered_my_posts = mysqli_query($connect, $select_filter);

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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">



    <link rel="stylesheet" href="./css/viewclientprofile.css">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> client profile</title>
</head>

<body>



    <div class="home">



        <div class="main">

            <div class="main-first">

                <div class="info">


                    <div class="img">
                        <img src="./images/<?php echo $image; ?>" alt="">
                    </div>
                    <h3>
                    <?php echo $clientname ?>
                    </h3>



                    <!-- <div class="rev-icon">
                        <span>
                            <a href="#">

                                <i class="fa-solid fa-star" style="color: black;"></i>

                            </a>
                        </span>
                    </div> -->

                </div>


            </div>




            <div class="main-sec">


                <div class="information">

                    <p>Full Name : <?php echo $clientname ?></p>
                    <p>Email : <?php echo $client_email ?></p>


    <?php if(!empty($_SESSION['freelancer_id'])) { ?>

                    <div class="chat-box" onclick="openChat()">
                        <a class="btn1" href="speak2.php?view=<?php echo $client_id?>"><i class="fa-solid fa-comment" ></i></a>  
                    </div>
                    <?php } ?>


                </div>



                <div class="upload">
                    <h2>Client's Posts</h2> 



                    <div class="main-sample">




                        <!-- start here -->

                        <?php if ($number_projects > 0) {
                        foreach ($filtered_my_posts as $data) { ?>

                        <div class="sample">
                           
                            <div class="info">

                                <h3><?php echo $data['project_name'] ?></h3>
                                <h4><?php echo $data['cat_name'] ?></h4>

                                <p><?php echo $data['post_desc'] ?></p>

                            </div>


                        </div>

                        <?php } 
                    } else { ?>
                        <h2>No projects yet</h2>
                    <?php } ?>

                        <!-- end loop here -->

                    </div>




                </div>

            </div>

        </div>
        

    </div>
   


    <div class="chat-box" onclick="openChat()">
        <h1>
            <a href="speak2.php?view=<?php echo $client_id?>"><i class="fa-solid fa-comment"></i></a>
        </h1>
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
 <script>
         var chatContainer = document.getElementById('container');

function openChat() {
    chatContainer.classList.toggle('d-none')
}
function closeChat() {
    chatContainer.classList.add('d-none')
}
    </script>

</body>

</html>