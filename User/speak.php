<?php
include("connection.php");
$client_id=isset($_SESSION['client_id'])?$_SESSION['client_id']:NULL;

if(isset($_GET['view_profile'])){
    $freelancerid=$_GET['view_profile'];
    $select_name="SELECT * FROM `freelancer` WHERE `freelancer_id`=$freelancerid";
    $run_name=mysqli_query($connect,$select_name);
$fetch = mysqli_fetch_assoc($run_name);
    $name=$fetch['freelancer_name'];
$_SESSION['freelancer']=$freelancerid;
}
?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Chat System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">



    <script>
        function aj() {
            var req = new XMLHttpRequest();
            req.onreadystatechange = function () {
                if (req.readyState == 4 && req.status == 200) {
                    document.getElementById('chat').innerHTML = req.responseText;
                }
            }
            req.open('GET', 'chat.php', true);
            req.send();
        }

        

        setInterval(function () { aj() }, 1000);


        

    </script>

    <link rel="stylesheet" href="./css/chat.css">
</head>

<body onload="aj();">



    <div id="container" class="container ">


        <div class="heading">
            <h3>
                Chat With <?php echo $name ?> <a href="viewprofile.php?view_profile=<?php echo $freelancerid ?>"><i class="fa-solid fa-x" onclick="closeChat()"></i></a>
            </h3>
        </div>


        <div id="chatbox" class="chatbox">
            <div id="chat" class="chat"></div>

        </div>
        <form method="POST">
            <input type="text" name="name" placeholder="Type Your Message...">
            <input type="submit" name="submit" value="send">
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $msg=mysqli_real_escape_string($connect,$_POST['name']);

            // $msg = $_POST['name'];
            if(!empty($msg)){

                $date=date("d-m-y h:i:s");
                $insert = "INSERT INTO `chat` values(NULL,$freelancerid,$client_id,'$msg','$date',0,'cf')";
                $run = mysqli_query($connect, $insert);
                header("location: speak.php?view_profile=$freelancerid");
            }
        }


        ?>
    </div>

    <div class="chat-box" onclick="openChat()">
        <h1>
            <i class="fa-solid fa-comment"></i>
        </h1>
    </div>




    <script src="./js/chat.js"></script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>