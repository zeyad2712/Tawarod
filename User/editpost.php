<?php
// include 'connection.php';
include "nav.php";


$client_id=$_SESSION['client_id'];
$category_query = "SELECT * FROM category";
$category_result = mysqli_query($connect, $category_query);
$post_id=$_GET['post_id'];
if(isset($_POST['submit'])){
    $post_desc=$_POST['post_desc'];
    $cat_id=$_POST['cat_id'];
    if (empty($cat_id)) {
 $insert = "UPDATE `posts` SET `post_desc`='$post_desc' WHERE `post_id`=$post_id";
$run_insert = mysqli_query($connect, $insert);
header("location:posts.php"); 

    }else{
    $insert = "UPDATE `posts` SET `post_desc`='$post_desc', `cat_id`='$cat_id' WHERE `post_id`=$post_id";
$run_insert = mysqli_query($connect, $insert);
    header("location:posts.php"); 
    }
}
$select="SELECT * FROM `posts` WHERE `post_id`=$post_id"; 
$run_select= mysqli_query($connect, $select);
$fetch=mysqli_fetch_assoc($run_select);
$content=$fetch['post_desc'];












?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Document</title>
</head>
<body>
<div class="popup" >

<div class="popup-content" >
    <h2>edit Post</h2>
    <form method="POST" name="category">

        <label for="postContent" class="cont">Content:</label>
        
        <textarea id="postContent" name="post_desc" required><?php echo $content ?></textarea>
        <div class="dropdownlist">
            <label for="cat">Category:</label><br>

            <select name="cat_id"   id="cat">
            <option value="cat_id" disabled hidden selected>Category</option>
            <?php  foreach($category_result as $data){?>
    <option name="category" value="<?php echo $data['cat_id']; ?>" 
        ><?php echo $data['cat_name']; ?>

    </option>
<?php } ?>
            </select>
        </div>
      
        
        <button  name="submit" type="submit" class="add">update</button>
    </form>
</div>
</div>
</body>
</html>