<?php
// include("connection.php");
include 'nav.php';
 $query ="SELECT * FROM `freelancer` WHERE `hide`=0 ORDER BY `average_rate` DESC LIMIT 5  ";
$result=mysqli_query($connect,$query);

// note
if(isset($_SESSION['client_id'])){
    $client_id=$_SESSION['client_id'];
        $select_notee="SELECT * FROM `chat`
        JOIN `freelancer` ON `freelancer`.`freelancer_id`=`chat`.`freelancer_id`
         WHERE `chat`.`client_id`=$client_id AND `seen`=0 AND `from_to`='fc' order by `chat_id`";
         $run_notee=mysqli_query($connect,$select_notee);
         $number_c=mysqli_num_rows($run_notee);
    }
    if(isset($_SESSION['freelancer_id'])){
        $freelancer_id=$_SESSION['freelancer_id'];
            $select_note="SELECT * FROM `chat`
            JOIN `client` ON `client`.`client_id`=`chat`.`client_id`
             WHERE `chat`.`freelancer_id`=$freelancer_id AND `seen`=0 AND `from_to`='cf' order by `chat_id`";
         $run_note=mysqli_query($connect,$select_note);
         $number_f=mysqli_num_rows($run_note);
    
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    
    <div class="main">





    <div class="community">
            <div class="main-title">
                <h1>Connect With Our <br> Community</h1>
                <p>Our community section is a vibrant hub where freelancers and clients can connect,<br> share ideas, and collaborate on projects. Whether you're seeking advice, looking for team members,<br> or simply want to network with like-minded professionals. our community is the place to be.</p>
            </div>
            <div class="com-btn">
               <a href="community.php"> OUR COMMUNITY</a>
            </div>
        </div>






















        <div class="main-category">
            <a href="./freelancers_developer.php?freelancers=4" class="category-it">
                <h1>IT</h1>
                <div class="layer"></div>
            </a>
            <a href="./freelancers_marketing.php?freelancers=5" class="category-mrk">
                <h1>Marketing</h1>
                <div class="layer"></div>
            </a>
            <a href="./freelancers_designer.php?freelancers=8" class="category-grd">
                <h1>Designer</h1>
                <div class="layer"></div>
            </a>
            <a href="./freelancers_dataanalyst.php?freelancers=7" class="category-ad">
                <h1>Data anlyst</h1>
                <div class="layer"></div>
            </a>
            <a href="./freelancers_voiceover.php?freelancers=6" class="category-psh">
                <h1>Voice over</h1>
                <div class="layer"></div>
            </a>
            <a href="./freelancers_contentcreater.php?freelancers=9" class="category-arc">
                <h1>Content creater</h1>
                <div class="layer"></div>
            </a>
        </div>


        <div class="txt">
            <h1>
                Top FreeLancers
            </h1>
        </div>

        <!-- start -->
    
        
        <div class="top-lancers">


        <?php if ($result && $result->num_rows > 0) { ?>


            <?php while ($row = $result->fetch_assoc()) { ?>



            <a href="viewprofile.php?view_profile=<?php echo $row['freelancer_id']?>" class="lanc-card">
                <div class="img">
                    <img src="images/<?php echo $row ['freelancer_image']; ?>">
                </div>

                <div class="lanc-info">
                    <h3><?php echo $row['freelancer_name']; ?></h3>
                    <span>Average Rate: </span><p><?php echo $row['average_rate']; ?></p>
                </div>
            </a>

            <?php }
         }?>
            
      
        </div>



        <footer>

<div class="footer-sections">
    <h2>For Clients</h2>
    <ul>
        <li>
            <a href="#hire">How To Hire</a>
        </li>
        <li>
            <a href="#">Talent Marketplace</a>
        </li>
        <li>
            <a href="#">Enterprise</a>
        </li>
        <li>
            <a href="#">Contract To Hire</a>
        </li>

    </ul>
</div>

<div class="footer-sections">
    <h2>Resources</h2>

    <ul>
        <li>
            <a href="#">Help</a>
        </li>
        <li>
            <a href="#">Success Stories</a>
        </li>
        <li>
            <a href="#">Blog</a>
        </li>
        <li>
            <a href="#">Comunity</a>
        </li>

    </ul>
</div>

<div class="footer-sections">
    <h2>Support</h2>

    <ul>
        <li>
            <a href="#">Trust & Safety</a>
        </li>
        <li>
            <a href="#">Quality Guide</a>
        </li>
        <li>
            <a href="#">Support</a>
        </li>
    </ul>
</div>

<div class="footer-sections">
    <h2>Company</h2>

    <ul>
        <li>
            <a href="#about">About Us</a>
        </li>
        <li>
            <a href="#">Leadership</a>
        </li>
        <li>
            <a href="#">Careers</a>
        </li>
    </ul>
</div>

<div class="footer-sections1">
    <h2>Follow Us:</h2>
    <button>
        <a href="#"><i class="fa-brands fa-facebook"></i></a>
    </button>
    <button>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
    </button>
    <button>
        <a href="#"><i class="fa-brands fa-youtube"></i></a>
    </button>
    <button>
        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
    </button>
    <button>
        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
    </button>
</div>

<hr style="width:100%">

<div class="terms">

    <div class="copy">
        <h4>
            <i class="fa-regular fa-copyright"></i> 2015 - 2024 Website Name® Inc.
        </h4>
    </div>

    <div class="list">
        <ul>
            <li>
                <a href="#">Terms Of Service</a>
            </li>
            <li>
                <a href="#">Privacy Policy</a>
            </li>
            <li>
                <a href="#">Cookie Settings</a>
            </li>
            <li>
                <a href="#">Accessibility</a>
            </li>
        </ul>
    </div>
</div>


</footer>

<!--                           note eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee-->

 <div class="notification" onclick="openList()">

        <i class="fa-solid fa-bell"></i>
        <span>
       <?php if(!empty($_SESSION['freelancer_id'])) { echo $number_f; } elseif(!empty($_SESSION['client_id'])) { echo $number_c ; }?>

        </span>
    </div>

    <div class="not-list d-none" id="not-list">
        <?php if(!empty($_SESSION['freelancer_id'])) { 
         foreach($run_note as $data) { ?>
        <div class="user">
        <a href="speak2.php?view=<?php echo $data['client_id'];?>">
            <img src="./images/<?php echo $data['client_image'];?>" alt=""> <?php echo $data['client_name'];?>
            
        </a>
        </div>
        <?php } } elseif(!empty($_SESSION['client_id'])) {
            foreach($run_notee as $data){ 
            ?>
        <div class="user">
        <a href="speak.php?view_profile=<?php echo $data['freelancer_id'];?>">
            <img src="./images/<?php echo $data['freelancer_image'];?>" alt=""> <?php echo $data['freelancer_name'];?>
            
        </a>
        </div>
        <?php } } ?>
      
    </div>
 <script>
    var notlist = document.getElementById("not-list")

    function openList(){
        notlist.classList.toggle("d-none")
    }
</script>



        <!-- end -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleButton = document.getElementById('switch');
            const body = document.body;

            // Check if dark mode is enabled in localStorage
            if (localStorage.getItem('dark-mode') === 'enabled') {
                body.classList.add('dark-mode');
                toggleButton.checked = true; // Set the switch to checked if dark mode is enabled
            }

            toggleButton.addEventListener('click', () => {
                // Toggle dark mode
                body.classList.toggle('dark-mode');

                // Save the user's preference in localStorage
                if (body.classList.contains('dark-mode')) {
                    localStorage.setItem('dark-mode', 'enabled');
                } else {
                    localStorage.removeItem('dark-mode');
                }
            });
        });



    </script>

<script>
    var notlist = document.getElementById("not-list")

    function openList(){
        notlist.classList.toggle("d-none")
    }
</script>
</body>

</html>