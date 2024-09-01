<?php 
include 'mail.php';

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">



    <link rel="stylesheet" href="./css/nav.css">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
        <?php if(isset($_SESSION['client_id']) || isset($_SESSION['freelancer_id'])) { ?>

            <a class="navbar-brand" href="./homee.php">Tawarod</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php }else{  ?>  



<a class="navbar-brand" href="#">Tawarod</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>


          <?php  } ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 mx-5">
                    <?php if(isset($_SESSION['client_id']) || isset($_SESSION['freelancer_id'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./homee.php">HOME</a>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./posts.php?page_nr=1">POST</a>
                    </li>
                    <li class="nav-item">
                        <?php if(isset($_SESSION['client_id'])) { ?>
                        <a class="nav-link active" aria-current="page" href="./clientprofile.php">PROFILE</a>
                        <?php } ?>
                    </li>
                    <li class="nav-item"> 
                        <?php if(isset($_SESSION['client_id'])) { ?>

                        <a class="nav-link active" aria-current="page" href="wishlist1.php">WISHLIST</a>
                        <?php } ?>
                    </li>
                    <li class="nav-item1">
                        <?php if(isset($_SESSION['freelancer_id'])) { ?>
                        <a class="nav-link active" aria-current="page" href="freelancerprofile mena.php">PROFILE</a>
                        <?php } ?>
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link active" aria-current="page" href="all-freelancer.php?page_nr=1">All Freelancers</a>
                    </li>

                    <li class="nav-item ">
                        <label class="toggle" for="switch">
                            <input id="switch" class="input" type="checkbox">
                            <div class="icon icon--moon">
                                <svg height="32" width="32" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path clip-rule="evenodd"
                                        d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z"
                                        fill-rule="evenodd"></path>
                                </svg>
                            </div>

                            <div class="icon icon--sun">
                                <svg height="32" width="32" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z">
                                    </path>
                                </svg>
                            </div>
                        </label>
                    </li>
                            
                            <?php if(!isset($_SESSION['client_id'])&& !isset($_SESSION['freelancer_id'])) { ?>
                  
                    <li class="nav-item ">
                        <a class="nav-link" href="./signup.php"
                           >
                            Sign Up
                        </a> 
                    </li>
                    
                    







                    










<?php } ?>
<?php  if(!isset($_SESSION['client_id']) && !isset($_SESSION['freelancer_id'])) { ?>  

<li class="nav-item ">
    <a class="nav-link" href="./login.php"
    >
    Login
</a> 
</li> 
<?php } ?>

<?php  if(isset($_SESSION['client_id'])||isset($_SESSION['freelancer_id'])) { ?>  
                <form method="POST">
                <li class="nav-item2 btn">
                    <button class="btn-log" name="logout" >
                        Logout
                    </button>
                </li>
                </form>
<?php } ?>

            </div>
        </div>
    </nav>
                        </body>
                        </html>
