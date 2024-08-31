<?php
include ('nav.php');

// Uncomment and use session if needed
// session_start(); 
$error="";
$freelancer_id=$_SESSION['freelancer_id'];
 //  replace with session value if needed
// $FLid = $_SESSION['freelancer_id']; // Use session if needed
// $FLid = $freelancer_id; 
$FL_name = "";
$about = "";
// $cat_id=$_POST['sub_b'];
$Price_Hour = "";

// $select_cat="SELECT * FROM `category` ";
// $run_cat=mysqli_query($connect , $select_cat);


$rrrrr="SELECT * FROM `rank`";
$rankk=mysqli_query($connect,$rrrrr);



$freelancer_cat="SELECT * FROM `freelancer` WHERE `freelancer_id` = $freelancer_id";
$runF=mysqli_query($connect,$freelancer_cat);
$fett=mysqli_fetch_assoc($runF);
$cat_id=$fett['cat_id'];

$select_sub="SELECT * FROM `sub_category` WHERE `cat_id` = $cat_id ";
$run_sub=mysqli_query($connect ,$select_sub);

if (isset($_GET['edit'])) {
$FLid=$_GET['edit'];

    $select = "SELECT * FROM `freelancer` WHERE `freelancer_id` = $FLid";
    $run_select = mysqli_query($connect, $select);
    if ($run_select) {
        $fetch = mysqli_fetch_assoc($run_select);
        $freelancer_name = $fetch['freelancer_name'];
        $freelancer_about = $fetch['about'];
        $freelancer_price_Hours= $fetch['price/hour'];
        $old_img=$fetch['freelancer_image'];
        $job=$fetch['job_title'];
        $rank=$fetch['rank_id'];
        $sub=$fetch['subcat_id'];
    } else {
        echo "Error fetching data: " . mysqli_error($connect);
    }
    
    if (isset($_POST['submit'])) {
        $freelancer_name = $_POST['freelancer_name'];
        $freelancer_about = $_POST['about'];
        $freelancer_price_Hours = $_POST['Price_hour'];
        $image = $_FILES['image']['name'];
        $job=$_POST['job'];
        if(!isset($_POST['rank'])){
        $rank=$fetch['rank_id'];

        }else{
        $rank=$_POST['rank'];}
        if(!isset($_POST['sub'])){
            $sub=$fetch['subcat_id'];

    
            }else{
                $sub=$_POST['sub'];}


        // if(!empty($freelancer_name) && !empty($freelancer_about) && !empty($freelancer_price_Hours)){
            
            
            if (empty($image)) {
            if(!empty($rank) &&!empty($freelancer_name) &&!empty($freelancer_about) && !empty($freelancer_price_Hours) && !empty($job) &&!empty($sub)){

                $update = "UPDATE freelancer SET `freelancer_name`='$freelancer_name', `about`='$freelancer_about', `Price/Hour`='$freelancer_price_Hours',`rank_id`=$rank,`subcat_id`='$sub' ,`job_title`='$job' WHERE freelancer_id='$FLid'";
                $run_update = mysqli_query($connect, $update);
            }else{
                $error="please, put the required data";
            }

        }else {        

                    move_uploaded_file($_FILES['image']['tmp_name'], "./images/".$image);
                    if(!empty($rank) &&!empty($freelancer_name) &&!empty($freelancer_about) && !empty($freelancer_price_Hours) && !empty($job) &&!empty($sub)){

                        $update = "UPDATE freelancer SET freelancer_name='$freelancer_name', about='$freelancer_about', `Price/Hour`='$freelancer_price_Hours', `freelancer_image`='$image' ,`rank_id`=$rank,`subcat_id`=$sub ,`job_title`='$job' WHERE freelancer_id='$FLid'";
                        $run_update = mysqli_query($connect, $update);
            }else{
                $error="please, put the required data";
            }
                    
                }
                
                if (isset($run_update)) {

                    echo "Profile updated successfully.";
                    header("location:freelancerprofile mena.php?edit=$FLid");

                } else {
                    echo $error;
                }
                
            // }
            // else{
            //     echo "Please put the required data";
                
            // }
            
            // Uncomment to redirect after update
            // header("Location: freelancer_profile.php");
            // exit();
        }
    }    

        ?>
  <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="./css/editprofil.css">
    <title>Edit Your Profile</title>
</head>

<body>
    <svg id="wave" style="transform:rotate(180deg); transition: 0.3s" viewBox="0 0 1440 180" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(8, 27, 27, 1)" offset="0%"></stop><stop stop-color="rgba(53.618, 136.204, 136.204, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,0L40,24C80,48,160,96,240,105C320,114,400,84,480,72C560,60,640,66,720,84C800,102,880,132,960,120C1040,108,1120,54,1200,39C1280,24,1360,48,1440,57C1520,66,1600,60,1680,57C1760,54,1840,54,1920,54C2000,54,2080,54,2160,60C2240,66,2320,78,2400,81C2480,84,2560,78,2640,78C2720,78,2800,84,2880,75C2960,66,3040,42,3120,54C3200,66,3280,114,3360,123C3440,132,3520,102,3600,96C3680,90,3760,108,3840,111C3920,114,4000,102,4080,105C4160,108,4240,126,4320,120C4400,114,4480,84,4560,63C4640,42,4720,30,4800,42C4880,54,4960,90,5040,93C5120,96,5200,66,5280,51C5360,36,5440,36,5520,45C5600,54,5680,72,5720,81L5760,90L5760,180L5720,180C5680,180,5600,180,5520,180C5440,180,5360,180,5280,180C5200,180,5120,180,5040,180C4960,180,4880,180,4800,180C4720,180,4640,180,4560,180C4480,180,4400,180,4320,180C4240,180,4160,180,4080,180C4000,180,3920,180,3840,180C3760,180,3680,180,3600,180C3520,180,3440,180,3360,180C3280,180,3200,180,3120,180C3040,180,2960,180,2880,180C2800,180,2720,180,2640,180C2560,180,2480,180,2400,180C2320,180,2240,180,2160,180C2080,180,2000,180,1920,180C1840,180,1760,180,1680,180C1600,180,1520,180,1440,180C1360,180,1280,180,1200,180C1120,180,1040,180,960,180C880,180,800,180,720,180C640,180,560,180,480,180C400,180,320,180,240,180C160,180,80,180,40,180L0,180Z"></path><defs><linearGradient id="sw-gradient-1" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(193, 141, 82, 1)" offset="0%"></stop><stop stop-color="rgba(193, 141, 82, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 50px); opacity:0.9" fill="url(#sw-gradient-1)" d="M0,0L40,0C80,0,160,0,240,15C320,30,400,60,480,87C560,114,640,138,720,129C800,120,880,78,960,54C1040,30,1120,24,1200,42C1280,60,1360,102,1440,108C1520,114,1600,84,1680,69C1760,54,1840,54,1920,63C2000,72,2080,90,2160,90C2240,90,2320,72,2400,54C2480,36,2560,18,2640,27C2720,36,2800,72,2880,93C2960,114,3040,120,3120,114C3200,108,3280,90,3360,90C3440,90,3520,108,3600,108C3680,108,3760,90,3840,96C3920,102,4000,132,4080,123C4160,114,4240,66,4320,48C4400,30,4480,42,4560,63C4640,84,4720,114,4800,120C4880,126,4960,108,5040,108C5120,108,5200,126,5280,123C5360,120,5440,96,5520,72C5600,48,5680,24,5720,12L5760,0L5760,180L5720,180C5680,180,5600,180,5520,180C5440,180,5360,180,5280,180C5200,180,5120,180,5040,180C4960,180,4880,180,4800,180C4720,180,4640,180,4560,180C4480,180,4400,180,4320,180C4240,180,4160,180,4080,180C4000,180,3920,180,3840,180C3760,180,3680,180,3600,180C3520,180,3440,180,3360,180C3280,180,3200,180,3120,180C3040,180,2960,180,2880,180C2800,180,2720,180,2640,180C2560,180,2480,180,2400,180C2320,180,2240,180,2160,180C2080,180,2000,180,1920,180C1840,180,1760,180,1680,180C1600,180,1520,180,1440,180C1360,180,1280,180,1200,180C1120,180,1040,180,960,180C880,180,800,180,720,180C640,180,560,180,480,180C400,180,320,180,240,180C160,180,80,180,40,180L0,180Z"></path><defs><linearGradient id="sw-gradient-2" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(90, 143, 118, 1)" offset="0%"></stop><stop stop-color="rgba(90, 143, 118, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 100px); opacity:0.8" fill="url(#sw-gradient-2)" d="M0,0L40,3C80,6,160,12,240,18C320,24,400,30,480,51C560,72,640,108,720,105C800,102,880,60,960,54C1040,48,1120,78,1200,102C1280,126,1360,144,1440,150C1520,156,1600,150,1680,129C1760,108,1840,72,1920,48C2000,24,2080,12,2160,30C2240,48,2320,96,2400,123C2480,150,2560,156,2640,147C2720,138,2800,114,2880,96C2960,78,3040,66,3120,72C3200,78,3280,102,3360,102C3440,102,3520,78,3600,78C3680,78,3760,102,3840,96C3920,90,4000,54,4080,36C4160,18,4240,18,4320,27C4400,36,4480,54,4560,75C4640,96,4720,120,4800,132C4880,144,4960,144,5040,126C5120,108,5200,72,5280,66C5360,60,5440,84,5520,96C5600,108,5680,108,5720,108L5760,108L5760,180L5720,180C5680,180,5600,180,5520,180C5440,180,5360,180,5280,180C5200,180,5120,180,5040,180C4960,180,4880,180,4800,180C4720,180,4640,180,4560,180C4480,180,4400,180,4320,180C4240,180,4160,180,4080,180C4000,180,3920,180,3840,180C3760,180,3680,180,3600,180C3520,180,3440,180,3360,180C3280,180,3200,180,3120,180C3040,180,2960,180,2880,180C2800,180,2720,180,2640,180C2560,180,2480,180,2400,180C2320,180,2240,180,2160,180C2080,180,2000,180,1920,180C1840,180,1760,180,1680,180C1600,180,1520,180,1440,180C1360,180,1280,180,1200,180C1120,180,1040,180,960,180C880,180,800,180,720,180C640,180,560,180,480,180C400,180,320,180,240,180C160,180,80,180,40,180L0,180Z"></path></svg>
    <div class="container">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    <!-- <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Maxwell Admin"> -->
                                    <?php if(!empty($image)){ ?>
                                    <img src="./images/<?php echo $image?>" alt="Maxwell Admin">
                                    <?php }elseif($old_img){ ?>
                                        <img src="./images/<?php echo $old_img?>" alt="Maxwell Admin">
                                        <?php }else{ ?>
                                            <img src="./images/<?php echo $old_img?>" alt="Maxwell Admin"> 
                                            <?php }?>
                                </div>
                                <form method="POST" enctype="multipart/form-data">
                                <label class="filelabel" for="file"><i class="fa-sharp fa-solid fa-pen"></i> Edit your
                                    profile
                                    picture</label>
                                <br>
                                <input class="fileinput" type="file" name="image" id="file" value="<?php if(isset($image)){echo $image;}else{echo $old_img;}?>">
                                <!-- <h5 class="user-name">Yuki Hayashi</h5> -->
                                <!-- <h6 class="user-email">yuki@Maxwell.com</h6> -->
                            </div>
                            <div class="about">
                                <!-- <h5>About</h5> -->
                                <!-- <p>I'm Yuki. Full Stack Designer I enjoy creating user-centric, delightful and human experiences.</p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <!-- ALFORM -->
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Personal Details</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" class="form-control" name="freelancer_name" id="fullName" value="<?php echo $freelancer_name ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="Price_Hours">Price/Hour</label>
                                    <input type="text" class="form-control" name="Price_hour" id="Price_Hours"  value="<?php echo $freelancer_price_Hours ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="About">About</label>
                                    <input type="text" class="form-control" name="about" id="About"  value="<?php echo $freelancer_about ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="website">Job Title</label>
                                    <input type="text" class="form-control" id="website" value="<?php echo $job ?>" name="job">
                                </div>
                            </div>

                          <?php if($cat_id!=6 && $cat_id!=7 && $cat_id!=9)  { ?>                 
                            <div class="dropdown"> 


                            <select name="sub" class="select" id="" value="<?php echo $sub ?>">
                                <option disabled hidden selected> Sub-Category</option>
                                <?php foreach ($run_sub as $key){ ?>
                                <option value="<?php echo $key['sub_cat_id'] ; ?>" <?php if($sub ==$key['sub_cat_id']){ echo "selected";}?>><?php echo $key ['sub_cat'] ?></option>
                            <?php } ?>
                            </select>
                        <?php } ?>


                            <select name="rank"  class="select" id="">
<option disabled hidden selected> Rank</option>
    <?php foreach ($rankk as $rawda){ ?>
    <option value="<?php echo $rawda['rank_id'] ?>" <?php if($rank ==$rawda['rank_id']){ echo "selected";}?>><?php echo $rawda ['rank_name'] ?></option>
    <?php } ?>
</select>

  <!-- <button class="btn-1 btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
    Category -->

        <!-- <ul class="dropdown-menu dropdown-submenu">
          <li>
            <a class="dropdown-item" href="#">Submenu item 1</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Submenu item 2</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Submenu item 3 &raquo; </a>
            <ul class="dropdown-menu dropdown-submenu">
              <li>
                <a class="dropdown-item" href="#">Multi level 1</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">Multi level 2</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="dropdown-item" href="#">Submenu item 4</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Submenu item 5</a>
          </li>
        </ul>
      </li> -->
</div>




                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <!-- <h6 class="mt-3 mb-2 text-primary">Address</h6> -->
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <!-- <label for="Street">Street</label> -->
                                    <!-- <input type="name" class="form-control" id="Street" placeholder="Enter Street"> -->
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <!-- <label for="ciTy">City</label> -->
                                    <!-- <input type="name" class="form-control" id="ciTy" placeholder="Enter City"> -->
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <!-- <label for="sTate">State</label> -->
                                    <!-- <input type="text" class="form-control" id="sTate" placeholder="Enter State"> -->
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <!-- <label for="zIp">Zip Code</label> -->
                                    <!-- <input type="text" class="form-control" id="zIp" placeholder="Zip Code"> -->
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <!-- <button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button> -->
                                    <!-- ALBUTTON -->
                                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Save
                                        Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>