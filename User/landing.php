<?php
include("nav.php");
$select_free="SELECT COUNT(*) AS total FROM `freelancer`  ";
$run_free=mysqli_query($connect,$select_free);
$fetch =mysqli_fetch_assoc($run_free);
$total_freelancers=$fetch['total'];
$select_client="SELECT COUNT(*) AS totalc FROM `client`  ";
$run_client=mysqli_query($connect,$select_client);
$fetch =mysqli_fetch_assoc($run_client);
$total_client=$fetch['totalc'];
$select_posts="SELECT COUNT(*) AS posts FROM `posts`  ";
$run_posts=mysqli_query($connect,$select_posts);
$fetch =mysqli_fetch_assoc($run_posts);
$total_posts=$fetch['posts'];
$select_project="SELECT COUNT(*) AS projects FROM `payment`  ";
$run_project=mysqli_query($connect,$select_project);
$fetch =mysqli_fetch_assoc($run_project);
$total_projects=$fetch['projects'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>

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

    <!-- link css file -->
    <link rel="stylesheet" href="./css/landing.css">
</head>

<body>

    <div class="container">

        <!-- first section -->

        <div class="section">

            <div class="left">
                <h1>
                    Why Hire <br>When You Can Tawarod?
                </h1>
                <h3>
                    Join Us Now-Connect with Top Experts and Watch Your Business Thrive. Don't Settle for Less!
                </h3>
                <button class="btn">
                    <a href="signup.php">
                        Join Us
                    </a>
                </button>
            </div>
            <div class="right">
                <img src="./images/logo (3).png" alt="img">
            </div>
        </div>


        <!-- second section -->


        <div class="section" id="about">

            <div class="title">
                <h1>About Us</h1>
                <p>Tawrud is a leading freelancing platfrom in Egypt, offering a wide range of services in marketing,
                    development, data analysis, voice-over, design and content creation</p>
                <p>Tawrud was founded to empower Egyptian freelancers by providing them a platform to show their skills
                    and connect with clients of the middle east. we want to make a community where creativity and
                    expertise meet together</p>
            </div>
        </div>

        <!-- third section -->


        <div class="video-section" id="hire">


            <div class="video">

                <video width="100%" controls>
                    <source src="" type="video/mp4">
                </video>

            </div>



            <div class="desc">
                <p>
                    In this video we present you a simple brief of our website how to sign in, leave your feedback, see
                    the freelancers rate and choose what you need easily
                </p>
            </div>




        </div>

        <!-- forth section -->

       <div class="section1" id="section1">
            <div class="card-holder">
                <div class="card1 card">
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
                <div class="card1 card">
                    <div class="icon">
                        <h1>
                            <i class="fa-solid fa-scroll"></i>
                        </h1>
                    </div>
                    <div class="stilte">
                        <h4>
                            <?php echo $total_posts ?>
                        </h4>
                        <p>No. Of Posts</p>
                    </div>
                </div>
                <div class="card1 card">
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
                <div class="card1 card">
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

        <!-- fifth section -->



        <div class="section1">

            <h1>
                A whole world of freelance <br>talent at your fingertips
            </h1>

            <div class="card-holder">

                <div class="card1">
                    <div class="icon">
                        <h3>
                            <i class="fa-solid fa-list"></i>
                        </h3>
                    </div>
                    <div class="stilte">
                        <h4>
                            Over 5 categories
                        </h4>
                        <p>Get results from skilled freelancers from all over the world, for every task, at any price
                            point.</p>
                    </div>
                </div>
                <div class="card1">
                    <div class="icon">
                        <h3>
                            <i class="fa-solid fa-handshake-simple"></i>
                        </h3>
                    </div>
                    <div class="stilte">
                        <h4>
                            Clear, transparent pricing
                        </h4>
                        <p>Pay per project or by the hour (Pro). Payments only get released when you approve.</p>
                    </div>
                </div>
                <div class="card1">
                    <div class="icon">
                        <h3>
                            <i class="fa-solid fa-bolt"></i>
                        </h3>
                    </div>
                    <div class="stilte">
                        <h4>
                            Quality work done faster
                        </h4>
                        <p>Filter to find the right freelancers quickly and get great work delivered in no time, every
                            time.</p>
                    </div>
                </div>
                <div class="card1">
                    <div class="icon">
                        <h3>
                            <i class="fa-solid fa-life-ring"></i>
                        </h3>
                    </div>
                    <div class="stilte">
                        <h4>
                            24/7 award-winning support
                        </h4>
                        <p>Chat with our team to get your questions answered or resolve any issues with your orders.</p>
                    </div>
                </div>
            </div>


        </div>







    </div>


    <!-- footer -->

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



    <!-- link js bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>

        document.addEventListener('DOMContentLoaded', () => {
            const toggleButton = document.getElementById('switch');
            const heading = document.getElementById('heading');
            const about = document.getElementById('about');
            const hire = document.getElementById('hire');
            const section1 = document.getElementById('section1');
            const cards = document.querySelectorAll('.card'); // Select all cards
            const body = document.body;

            // Check if dark mode is enabled in localStorage
            if (localStorage.getItem('dark-mode') === 'enabled') {
                body.classList.add('dark-mode');
                heading.classList.add('dark-mode-heading');
                cards.forEach(card => card.classList.add('dark-mode-card-section')); // Apply to all cards
                toggleButton.checked = true; // Set the switch to checked if dark mode is enabled
            }

            toggleButton.addEventListener('click', () => {
                // Toggle dark mode
                body.classList.toggle('dark-mode');
                heading.classList.toggle('dark-mode-heading');
                cards.forEach(card => card.classList.toggle('dark-mode-card-section')); // Toggle all cards

                // Save the user's preference in localStorage
                if (body.classList.contains('dark-mode')) {
                    localStorage.setItem('dark-mode', 'enabled');
                } else {
                    localStorage.removeItem('dark-mode');
                }
            });
        });


    </script>
</body>

</html>
