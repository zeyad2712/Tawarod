<?php
// include('connection.php');
include('nav.php');

$start=0;
$rows_per_page=8;
$records="SELECT * FROM freelancer";
$run_records=mysqli_query($connect,$records);
$nr_of_rows=mysqli_num_rows($run_records);
$pages=ceil($nr_of_rows / $rows_per_page);
 
if(isset($_GET['page_nr'])){
   $page= $_GET['page_nr']-1;
   $start=$page * $rows_per_page;
}

$select = "SELECT * FROM `freelancer` WHERE `freelancer`.`hide`=0 LIMIT $start,$rows_per_page";
$RunSelect = mysqli_query($connect, $select);


if(isset($_POST['search_btn'])) {
    $text = $_POST['text'];
    $select_search = "SELECT * FROM `freelancer` WHERE (`freelancer_name` LIKE  '%$text%') OR (`job_title` LIKE  '%$text%') OR (`about` LIKE  '%$text%') AND (`freelancer`.`hide`=0)";
    $RunSelect = mysqli_query($connect, $select_search);  
}
if(isset($_POST['Developer'])) {
$select_dev="SELECT * FROM `freelancer`WHERE cat_id=4 AND `freelancer`.`hide`=0";
$run_dev=mysqli_query($connect , $select_dev);
}
elseif(isset($_POST['data'])) {
    $select_data="SELECT * FROM `freelancer` WHERE cat_id=5 AND `freelancer`.`hide`=0";
    $run_data=mysqli_query($connect ,$select_data);
}
elseif(isset($_POST['voice'])) {
    $select_voice="SELECT * FROM `freelancer`WHERE cat_id=6 AND `freelancer`.`hide`=0";
    $run_voice=mysqli_query($connect , $select_voice);
}
elseif(isset($_POST['Marketing'])) {
    $select_mark="SELECT * FROM `freelancer`WHERE cat_id=7 AND `freelancer`.`hide`=0";
    $run_mark=mysqli_query($connect , $select_mark);
}
elseif(isset($_POST['Designer'])) {
    $select_des="SELECT * FROM `freelancer`WHERE cat_id=8 AND `freelancer`.`hide`=0";
    $run_des=mysqli_query($connect ,  $select_des);
}
elseif(isset($_POST['content'])) {
    $select_con="SELECT * FROM `freelancer`WHERE cat_id=9 AND `freelancer`.`hide`=0";
    $run_con=mysqli_query($connect , $select_con );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Freelancers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/all-freelancer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="search">

        <form class="search-bar " method="post" action="">
            <input class="form-control me-2" type="text" name="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit" name="search_btn">Search</button>
        </form>
        
    </div>

   
    <div class="main-cat">
        <div class="categories">
        
            <form method="POST">
            <button type="submit" name="Developer" class="cat-item">Developer</button>
            <button type="submit" name="data" class="cat-item">data Analyst</button>
            <button type="submit" name="voice" class="cat-item">voice over</button>
            <button type="submit" name="Marketing" class="cat-item">Marketing</button>
            <button type="submit" name="Designer" class="cat-item">Designer</button>
            <button type="submit" name="content" class="cat-item">content creator</button>
            <button type="submit" name="-" class="cat-item">All categories</button>
</form>
        </div>
    </div>
    <?php if(isset($_POST['Developer'])){?>
                <div class="main">
        <?php while ($data = mysqli_fetch_assoc($run_dev)) { ?>
            <a href="viewprofile.php?view_profile=<?php echo $data['freelancer_id']?>" class="card">
                <div class="img">
                    <img src="<?php echo "images/".$data ['freelancer_image']?>" alt="Freelancer Image">
                </div>
                <div class="info">
                    <h2><?php echo $data['freelancer_name']; ?></h2>
                    <p class="title"><?php echo $data['job_title']; ?></p>
                    <p class="rate"><i class="fa-solid fa-star"></i><?php echo $data['average_rate']?></p>
                    <p class="price">Price/Hour: <?php echo $data['price/hour']; ?></p>
                </div>
            </a>
        <?php } ?>
        <?php }elseif(isset($_POST['data'])){ ?>
            <div class="main">
        <?php while ($data = mysqli_fetch_assoc($run_data)) { ?>
            <a href="viewprofile.php?view_profile=<?php echo $data['freelancer_id']?>" class="card">
                <div class="img">
                    <img src="<?php echo "images/".$data ['freelancer_image']?>" alt="Freelancer Image">
                </div>
                <div class="info">
                    <h2><?php echo $data['freelancer_name']; ?></h2>
                    <p class="title"><?php echo $data['job_title']; ?></p>
                    <p class="rate"><i class="fa-solid fa-star"></i><?php echo $data['average_rate']?></p>
                    <p class="price">Price/Hour: <?php echo $data['price/hour']; ?></p>
                </div>
            </a>
        <?php } ?>
            <?php }elseif(isset($_POST['voice'])){ ?>
                <div class="main">
        <?php while ($data = mysqli_fetch_assoc($run_voice)) { ?>
            <a href="viewprofile.php?view_profile=<?php echo $data['freelancer_id']?>" class="card">
                <div class="img">
                    <img src="<?php echo "images/".$data ['freelancer_image']?>" alt="Freelancer Image">
                </div>
                <div class="info">
                    <h2><?php echo $data['freelancer_name']; ?></h2>
                    <p class="title"><?php echo $data['job_title']; ?></p>
                    <p class="rate"><i class="fa-solid fa-star"></i><?php echo $data['average_rate']?></p>
                    <p class="price">Price/Hour: <?php echo $data['price/hour']; ?></p>
                </div>
            </a>
        <?php } ?>
                <?php }elseif(isset($_POST['Marketing'])){ ?>
                    <div class="main">
        <?php while ($data = mysqli_fetch_assoc($run_mark)) { ?>
            <a href="viewprofile.php?view_profile=<?php echo $data['freelancer_id']?>" class="card">
                <div class="img">
                    <img src="<?php echo "images/".$data ['freelancer_image']?>" alt="Freelancer Image">
                </div>
                <div class="info">
                    <h2><?php echo $data['freelancer_name']; ?></h2>
                    <p class="title"><?php echo $data['job_title']; ?></p>
                    <p class="rate"><i class="fa-solid fa-star"></i><?php echo $data['average_rate']?></p>
                    <p class="price">Price/Hour: <?php echo $data['price/hour']; ?></p>
                </div>
            </a>
        <?php } ?>
                    <?php }elseif(isset($_POST['Designer'])){ ?>
                        <div class="main">
        <?php while ($data = mysqli_fetch_assoc($run_des)) { ?>
            <a href="viewprofile.php?view_profile=<?php echo $data['freelancer_id']?>" class="card">
                <div class="img">
                    <img src="<?php echo "images/".$data ['freelancer_image']?>" alt="Freelancer Image">
                </div>
                <div class="info">
                    <h2><?php echo $data['freelancer_name']; ?></h2>
                    <p class="title"><?php echo $data['job_title']; ?></p>
                    <p class="rate"><i class="fa-solid fa-star"></i><?php echo $data['average_rate']?></p>
                    <p class="price">Price/Hour: <?php echo $data['price/hour']; ?></p>
                </div>
            </a>
        <?php } ?>
                        <?php }elseif(isset($_POST['content'])){ ?>
                            <div class="main">
        <?php while ($data = mysqli_fetch_assoc($run_con)) { ?>
            <a href="viewprofile.php?view_profile=<?php echo $data['freelancer_id']?>" class="card">
                <div class="img">
                    <img src="<?php echo "images/".$data ['freelancer_image']?>" alt="Freelancer Image">
                </div>
                <div class="info">
                    <h2><?php echo $data['freelancer_name']; ?></h2>
                    <p class="title"><?php echo $data['job_title']; ?></p>
                    <p class="rate"><i class="fa-solid fa-star"></i><?php echo $data['average_rate']?></p>
                    <p class="price">Price/Hour: <?php echo $data['price/hour']; ?></p>
                </div>
            </a>
        <?php } ?>
            <?php }else{?>
                <div class="main">
                    <?php while ($data = mysqli_fetch_assoc($RunSelect)) { ?>
                        <a href="viewprofile.php?view_profile=<?php echo $data['freelancer_id']?>" class="card">
                            <div class="img">
                                <img src="<?php echo "images/".$data ['freelancer_image']?>" alt="Freelancer Image">
                            </div>
                            <div class="info">
                                <h2><?php echo $data['freelancer_name']; ?></h2>
                                <p class="title"><?php echo $data['job_title']; ?></p>
                                <p class="rate"><i class="fa-solid fa-star"></i><?php echo $data['average_rate']?></p>
                                <p class="price">Price/Hour: <?php echo $data['price/hour']; ?></p>
                            </div>
                        </a>
                        <?php } ?>
                        <?php }  ?>
                    </div>
                                                                <!-- pagination  -->
                                                                <div class="num">

<div class="page_info">
            <?php 
            if(!isset($_GET['page_nr'])){
                $page=1;
            }else{
                $page=$_GET['page_nr'];
            }
            ?>
            Showing <?php echo $page ?> of <?php echo $pages ?> pages
        </div>
        <div class="pagination">
            <a href="?page_nr=1"><i class="fa-solid fa-backward-fast"></i></a>
                                              <!-- Previous -->
            <?php
            if(isset($_GET['page_nr'])&& $_GET ['page_nr']>1){
                ?>
            <a href="?page_nr=<?php echo $_GET['page_nr'] - 1 ?>"><i class="fa-solid fa-backward"></i></a>
            <?php
            }else{
                ?>
                <a><i class="fa-solid fa-backward"></i></a>
                <?php
            }
           ?>
<div class="page_number">
    <?php
    for($counter=1; $counter<= $pages ;$counter++ ){
        ?>
        <a class="pbtn" id= "myButton" href="?page_nr=<?php echo $counter ?>"><?php echo $counter ?></a>
        <?php
    }
    ?>

</div>
                                               <!-- next -->
<?php
            if(isset($_GET['page_nr'])){
                ?>
            <a href="?page_nr=<?php echo $_GET['page_nr']+1?>"><i class="fa-solid fa-forward"></i></a>
            <?php
            }else{
                if($_GET['page_nr'] >=$pages){
                ?>
                <a><i class="fa-solid fa-forward"></i></a>
                <?php
            }else{
                ?>
                <a href="?page_nr=<?php echo $_GET['page_nr']+1 ?>"><i class="fa-solid fa-forward"></i></a>
                <?php
            }
        }
           ?>
                                               <!-- last -->
            <a href="?page_nr=<?php echo $pages ?>"><i class="fa-solid fa-forward-fast"></i></a>
        
        </div>
</div>

<script>
    function activateLink(link) {
    if (currentActiveLink) {
        currentActiveLink.classList.remove('active');
    }
    link.classList.add('active');
    currentActiveLink = link;
}

document.querySelectorAll('a').forEach(anchor => {
    anchor.addEventListener('click', function(event) {
         // Prevent the default link behavior
        activateLink(this);
    });
});
</script>
                </body>
                </html>
                
