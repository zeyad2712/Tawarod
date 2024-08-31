<?php
// include 'connection.php';
include 'nav.php';

$start=0;
$rows_per_page=2;
$records="SELECT * FROM posts";
$run_records=mysqli_query($connect,$records);
$nr_of_rows=mysqli_num_rows($run_records);
$pages=ceil($nr_of_rows / $rows_per_page);
 
if(isset($_GET['page_nr'])){
   $page= $_GET['page_nr']-1;
   $start=$page * $rows_per_page;
}
if(isset($_GET['pagec_nr'])){
    $pagec= $_GET['pagec_nr']-1;
    $start=$pagec * $rows_per_page;
 }
// mt post pagination
 if(isset($_GET['pagem_nr'])){
    $pagem= $_GET['pagem_nr']-1;
    $start=$pagem * $rows_per_page;
 }
$client_id=null;
if(isset($_SESSION['client_id'])){
$client_id=$_SESSION['client_id'];
}


$select_post = "SELECT * FROM `posts` JOIN `project` ON `project`.`project_id` = `posts`.`project_id`
    JOIN `category` ON `posts`.`cat_id` = `category`.`cat_id`
    JOIN `client` ON `client`.`client_id` = `project`.`client_id`LIMIT $start,$rows_per_page";

$run_post = mysqli_query($connect, $select_post);


if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    $delete = "DELETE FROM `posts` WHERE `post_id` = $post_id";
    $run_delete = mysqli_query($connect, $delete);
    header("location:posts.php");
    exit();
}


$category_query = "SELECT * FROM category";
$category_result = mysqli_query($connect, $category_query);

$filter = false;
$filter_cat = false;
$category_filter = '';
$filtered_posts = [];

if (isset($_POST['filter'])) {
    $filter = true;
    $select_filter = "SELECT * FROM `posts`  JOIN `project` ON `project`.`project_id` = `posts`.`project_id`
    JOIN `category` ON `posts`.`cat_id` = `category`.`cat_id`
    JOIN `client` ON `client`.`client_id` = `project`.`client_id`

                      WHERE project.client_id = '$client_id' LIMIT $start,$rows_per_page ";
    $filtered_my_posts = mysqli_query($connect, $select_filter);
}

if (isset($_POST['filter_cat'])) {
    $filter_cat = true;
    $category_filter = $_POST['filter_cat'];
    $_SESSION['filter_cat']=$category_filter;
    $select_filter_cat="SELECT * FROM `posts` JOIN `project` ON `project`.`project_id` = `posts`.`project_id`
    JOIN `category` ON `posts`.`cat_id` = `category`.`cat_id`
    JOIN `client` ON `client`.`client_id` = `project`.`client_id` WHERE category.cat_id = '$category_filter' LIMIT $start,$rows_per_page";

    // if (!empty($category_filter)) {
    //     $select_filter_cat .= " ";
    // }

    $filtered_posts = mysqli_query($connect, $select_filter_cat);
}
if (isset($_GET['pagem_nr'])) {
    $filter = true;
    $select_filter = "SELECT * FROM `posts`  JOIN `project` ON `project`.`project_id` = `posts`.`project_id`
    JOIN `category` ON `posts`.`cat_id` = `category`.`cat_id`
    JOIN `client` ON `client`.`client_id` = `project`.`client_id`


                      WHERE project.client_id = '$client_id'LIMIT $start,$rows_per_page ";
    $filtered_my_posts = mysqli_query($connect, $select_filter);
}
                                       
if (isset($_GET['pagec_nr'])) {
    $filter_cat = true;
    $category_filter = $_SESSION['filter_cat'];
    $select_filter_cat="SELECT * FROM `posts` JOIN `project` ON `project`.`project_id` = `posts`.`project_id`
    JOIN `category` ON `posts`.`cat_id` = `category`.`cat_id`
    JOIN `client` ON `client`.`client_id` = `project`.`client_id` 
WHERE category.cat_id = '$category_filter' LIMIT $start,$rows_per_page";

    // if (!empty($category_filter)) {
    //     $select_filter_cat .= " ";
    // }

    $filtered_posts = mysqli_query($connect, $select_filter_cat);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>post page</title>

    <!-- fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- --------------------------- -->
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- googel font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="./css/post.css">
    <!-- --------------------------- -->

</head>
<?php
if(isset($_GET['page_nr'])){
    $id=$_GET['page_nr'];
}else{
    $id=1;
}
?>
<body>
  
<div class="container">

        <header class="header">
            <h1>Posts</h1>
        </header>
    <div class="name">
        <!-- -----------start pop-up---------- -->
<section class="buttons">
        <!-- -----------start add post button---------- -->
         <?php if (isset($client_id)){ ?>
      <button>  <a href="addpost.php" class="open"> <i class="fa-solid fa-plus"></i></a> </button>
        <?php } ?>
        <!-- -----------end add post button---------- -->
       

     
        <!-- <button class="my-posts">MY POSTS</button>
         -->
        <form method="POST">
            <?php if(isset($_SESSION['client_id'])){ ?>
                <button type="submit"  class ="my-posts" name="filter">My Posts</button>
                <?php }   ?>
                        </form>
        <!-- ----------search-section----------- -->
        <div class="search-container">
            <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Category
                </button>
                <form method="POST">
                <div id="myDropdown" class="dropdown-content">
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                 <?php foreach($run_post as $data)  {                 ?>
                 <?php } ?>
               <button name="category" class="dropdown-item">all posts </button>
                     
                    <?php  foreach($category_result as $data){?>
                <button name="filter_cat" class="dropdown-item" value="<?php echo $data['cat_id']; ?>" >
                <?php echo $data['cat_name']; ?>
                </button>
                
                <?php } ?>
               
            </div>
            
            </div>

        </div>

    </div>
   
</form>

</section>
<main class="posts">
        <!-- -------------start post 1------------ -->
<?php if(isset($_POST['filter_cat'])){?>
    <?php foreach($filtered_posts as $data)  {                 ?>
    <article class="post">
        <div class="img-name">
                <img src=" <?php echo "images/". $data ['client_image']?>" alt=""  class="post-image">
                <h2><?php echo $data['client_name']; ?> </h2>
            </div>
            <!-- -------------delete and edit------------ -->
            <div class="cloes">

                <!-- <a href="posts.php?delete=<?php echo $data ['post_id']?>" class="delete-btn" name="delete" data-post-id="post1"><i class="fa-solid fa-circle-xmark"></i></a>
                <a href="editpost.php?post_id=<?php echo $data ['post_id']?>" class="editbtn"><i class="fa-solid fa-pen-to-square"></i></a> -->
            </div>
        <div class="post-content">
            <h1  class="post-title"> <?php echo $data['project_name']; ?></h1>
            <p  class="post-meta"> <?php echo $data['cat_name']; ?> </p>
           
            
                <p class="post-snippet"><?php echo $data['post_desc']; ?></p>
      
           <a href="post details.php?post_id=<?php echo $data ['post_id']?>&&project_id=<?php echo $data ['project_id']?>"  class="read-more">comment   <i class="fa-regular fa-comment" style="color: #0a0a0a;"></i></a>        
                
        </div>
    </article>
    
        <?php } ?>

<?php }elseif(isset($_POST['filter'])){ ?>
    <?php foreach($filtered_my_posts as $data)  {                 ?>

<article class="post">
<div class="cloes">

<a href="posts.php?delete=<?php echo $data ['post_id']?>" class="delete-btn" name="delete" data-post-id="post1"><i class="fa-solid fa-circle-xmark"></i></a>
<a href="editpost.php?post_id=<?php echo $data ['post_id']?>" class="editbtn"><i class="fa-solid fa-pen-to-square"></i></a>
</div>
  <div class="img-name">
    <img src=" <?php echo "images/". $data ['client_image']?>" alt="" class="post-image">
    <h2><?php echo $data['client_name']; ?> </h2>
   </div>
    <!-- -------------delete and edit------------ -->
    
    <div class="post-content">
    <h1  class="post-title"><?php echo $data['project_name']; ?></h1>
    <h3 class="post-meta"> <?php echo $data ['cat_name']; ?> </h3>
    
   
        <p  class="post-snippet"><?php echo $data['post_desc']; ?></p>
   

      <a href="post details.php?post_id=<?php echo $data ['post_id']?>&&project_id=<?php echo $data ['project_id']?>" class="read-more">comment   <i class="fa-regular fa-comment" style="color: #0a0a0a;"></i></a>
            


    </div>

    </article>



 





 <?php } ?>

<?php }else{?>
    <?php foreach($run_post as $data)  {         ?>

        <article class="post">
        <div class="img-name">
           
           <img src=" <?php echo "images/". $data ['client_image']?>" alt=""  class="post-image">
            <h2><?php echo $data['client_name']; ?> </h2>
            </div>
            <!-- -------------delete and edit------------ -->
            <div class="cloes">

            <?php if($client_id == $data['client_id']) { ?> 
       
    <a href="posts.php?delete=<?php echo $data ['post_id']?>" class="delete-btn" name="delete" data-post-id="post1"><i class="fa-solid fa-circle-xmark"></i></a>
    <a href="editpost.php?post_id=<?php echo $data ['post_id']?>" class="editbtn"><i class="fa-solid fa-pen-to-square"></i></a>
 
    <?php } ?>
            </div>
        <div class="post-content">
            <h1 class="post-title"><?php echo $data['project_name']; ?></h1>
            <p  class="post-meta"> <?php echo $data['cat_name']; ?> </p>

                
            
            <p  class="post-snippet"><?php echo $data['post_desc']; ?></p>
          <a href="post details.php?post_id=<?php echo $data ['post_id']?>&&project_id=<?php echo $data ['project_id']?>"  class="read-more">comment  <i class="fa-regular fa-comment" style="color: #0a0a0a;"></i></a>     
        </div>

         

            

                

                  
           
        </article>
        <?php } ?>
        <?php }  ?>
        
        <!-- -------------end post 1------------ -->
         <!-- pagination  -->

         <?php if(isset($_GET['pagem_nr']) || isset($_POST['filter'])){ ?>


<div class="num">
        

        <div class="page_info">
                    <?php 
                    if(!isset($_GET['pagem_nr'])){
                        $pagem=1;
                    }else{
                        $pagem=$_GET['pagem_nr'];
                    }
                    ?>
                    Showing <?php echo $pagem ?> of <?php echo $pages ?> pages
                </div>
                <div class="pagination">
                    <a href="?pagem_nr=1"><i class="fa-solid fa-backward-fast"></i></a>
                                                      <!-- Previous -->
                    <?php
                    if(isset($_GET['pagem_nr'])&& $_GET ['pagem_nr']>1){
                        ?>
                    <a href="?pagem_nr=<?php echo $_GET['pagem_nr'] - 1 ?>"><i class="fa-solid fa-backward"></i></a>
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
                <a class="pbtn" id= "myButton" href="?pagem_nr=<?php echo $counter ?>"><?php echo $counter ?></a>
                <?php
            }
            ?>

        </div>
                                                       <!-- next -->
        <?php
                    if(!isset($_GET['pagem_nr'])){
                        ?>
                    <a href="?pagem_nr=1?>"><i class="fa-solid fa-forward"></i></a>
                    <?php
                    }else{
                        if($_GET['pagem_nr'] >=$pages){
                        ?>
                        <a><i class="fa-solid fa-forward"></i></a>
                        <?php
                    }else{
                        ?>
                        <a href="?pagem_nr=<?php echo $_GET['pagem_nr']+1 ?>"><i class="fa-solid fa-forward"></i></a>
                        <?php
                    }
                }
                   ?>
                                                       <!-- last -->
                    <a href="?pagem_nr=<?php echo $pages ?>"><i class="fa-solid fa-forward-fast"></i></a>
                
                </div>
        </div>
                                            
        

<?php }elseif(isset($_GET['pagec_nr']) || isset($_POST['filter_cat'])){?>






        <div class="num">
        

        <div class="page_info">
                    <?php 
                    if(!isset($_GET['pagec_nr'])){
                        $pagec=1;
                    }else{
                        $pagec=$_GET['pagec_nr'];
                    }
                    ?>
                    Showing <?php echo $pagec ?> of <?php echo $pages ?> pages
                </div>
                <div class="pagination">
                    <a href="?pagec_nr=1"><i class="fa-solid fa-backward-fast"></i></a>
                                                      <!-- Previous -->
                    <?php
                    if(isset($_GET['pagec_nr'])&& $_GET ['pagec_nr']>1){
                        ?>
                    <a href="?pagec_nr=<?php echo $_GET['pagec_nr'] - 1 ?>"><i class="fa-solid fa-backward"></i></a>
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
                <a class="pbtn" id= "myButton" href="?pagec_nr=<?php echo $counter ?>"><?php echo $counter ?></a>
                <?php
            }
            ?>

        </div>
                                                       <!-- next -->
        <?php
                    if(!isset($_GET['pagec_nr'])){
                        
                        ?>
                    <a href="?pagec_nr=2"><i class="fa-solid fa-forward"></i></a>
                    <?php
                    }else{
                        if($_GET['pagec_nr'] >=$pages){
                        ?>
                        <a><i class="fa-solid fa-forward"></i></a>
                        <?php
                    }else{
                        ?>
                        <a href="?pagec_nr=<?php echo $_GET['pagec_nr']+1 ?>"><i class="fa-solid fa-forward"></i></a>
                        <?php
                    }
                }
                   ?>
                                                       <!-- last -->
                    <a href="?pagec_nr=<?php echo $pages ?>"><i class="fa-solid fa-forward-fast"></i></a>
                
                </div>
        </div>
                                            
        






<?php } else { ?>











  
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
                                            
        




<?php } ?>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

        <script>
            let currentActiveLink = null;

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

        <script src="./js/post.js"></script>
</body>

</html>