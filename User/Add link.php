<?php
include 'connection.php';

$freelancer_id = $_SESSION['freelancer_id'];

if (isset($_POST['submit'])) {
    $link = $_POST['link'];


    $insert_link = "INSERT INTO `link`  VALUES ( NULL ,'$freelancer_id', '$link')";
    $run_insert = mysqli_query($connect, $insert_link);

    if ($run_insert) {
        echo "Link added successfully.";
    } else {
        echo "Error adding link: " . mysqli_error($connect);
    }
}


$select_links = "SELECT * FROM `link` WHERE `freelancer_id` = '$freelancer_id'";
$run_select = mysqli_query($connect, $select_links);

if (mysqli_num_rows($run_select) > 0) {
    echo "<h3>Your Links:</h3>";
    while ($row = mysqli_fetch_assoc($run_select)) {
        echo "<p><a href='{$row['link']}' target='_blank'>{$row['link']}</a></p>";
    }
} else {
    echo "No links added yet.";
}
?>
<form method="POST">
    <label for="link">Add Your Link:</label>
    <input type="url" name="link" id="link" required>
    <button type="submit" name="submit">Add Link</button>
</form>
