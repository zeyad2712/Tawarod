<?php 
include("connection.php");


$admin = $_SESSION['admin_id'];
$er_email = "";
$er_pass = "";
$er_pass1 = "";
$error_msg = "";

// Fetch admin details
$sel_ad = $connect->prepare("SELECT * FROM admin WHERE admin_id = ?");
$sel_ad->bind_param("i", $admin);
$sel_ad->execute();
$fetch = $sel_ad->get_result()->fetch_assoc();
$ad_name = $fetch['admin_name'];

// Fetch total counts
$queries = [
    'freelancers' => "SELECT COUNT(*) AS total FROM freelancer",
    'clients' => "SELECT COUNT(*) AS totalc FROM client",
    'reports' => "SELECT COUNT(*) AS reports FROM reports",
    'projects' => "SELECT COUNT(*) AS projects FROM payment"
];

$results = [];
foreach ($queries as $key => $query) {
    $stmt = $connect->prepare($query);
    $stmt->execute();
    $results[$key] = $stmt->get_result()->fetch_assoc();
}

// Fetch admins
$sel_admin = "SELECT * FROM admin";
$run_admin = $connect->query($sel_admin);

// Handle form submission for adding admin
if (isset($_POST['submit'])) {  
    $name = $_POST['admin_name'];
    $email = $_POST['admin_email'];
    $password = $_POST['admin_password'];
    $confirm_pass = $_POST['confirm_pass'];

    // Password hashing and validation
    $passwordhashing = password_hash($password, PASSWORD_DEFAULT);
    $lowercase = preg_match('@[a-z]@', $password);
    $uppercase = preg_match('@[A-Z]@', $password);
    $numbers = preg_match('@[0-9]@', $password);

    $select = $connect->prepare("SELECT * FROM admin WHERE admin_email = ?");
    $select->bind_param("s", $email);
    $select->execute();
    $rows = $select->get_result()->num_rows;

    if (empty($name) || empty($email) || empty($password) || empty($confirm_pass)) {
        $error_msg = "Please fill all required data";
    } elseif ($rows > 0) {
        $er_email = "This email is already taken";
    } elseif (!$lowercase || !$uppercase || !$numbers) {
        $er_pass = "Password must contain at least 1 uppercase, 1 lowercase, and 1 number";
    } elseif ($password != $confirm_pass) {
        $er_pass1 = "Password doesn't match confirmed password";
    } else {
        $insert = $connect->prepare("INSERT INTO admin (admin_name, admin_email, admin_password) VALUES (?, ?, ?)");
        $insert->bind_param("sss", $name, $email, $passwordhashing);
        $insert->execute();
        // echo "Data added successfully";
    }
}

// Handle form submission for banning freelancer
if (isset($_POST['submit1'])) {
    $freelancer_id = $_POST['freelancer_id'];
    $start_date = $_POST['date'];
    $days = $_POST['days'];

    if ($freelancer_id) {
        $update = "UPDATE freelancer SET ban = 1,time= '$start_date' , days = $days 
        WHERE freelancer_id = $freelancer_id";
   $run_update = mysqli_query($connect, $update);
   
    }
}

// Fetch reports for displaying
$select_reports = "SELECT * FROM reports
                     JOIN client ON client . client_id = reports . client_id
                     JOIN freelancer ON freelancer . freelancer_id = reports . freeelancer_id";
$run_select =  mysqli_query($connect , $select_reports);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Interface</title>
    <!-- link google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lancelot&display=swap" rel="stylesheet">
    <!-- link font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

<div class="sidebar">
    <div class="heading">
        <h5>Welcome <?php echo htmlspecialchars($ad_name); ?></h5>
    </div>
    <div class="list">
        <ul>
            <li><a href="#" onclick="closeRep()">Dashboard</a></li>
            <li><a href="#" onclick="openRep()">Reports</a></li>
            <li><a href="#" onclick="openAdm()">Admins</a></li>
            <li><a href="#" onclick="openAdd()">Add Admin</a></li>
        </ul>
    </div>
    <div class="log">
        <form method="POST">
            <button name="logout">Logout</button>
        </form>
    </div>
</div>

<div class="main-content" id="main-content">
    <div class="main-heading">
        <h1>Admin Interface</h1>
    </div>
    <div class="dash">
        <div class="dash-heading">
            <h1>Dashboard</h1>
        </div>
        <div class="card-holder">
            <div class="card1">
                <div class="icon"><h1><i class="fa-solid fa-list-check"></i></h1></div>
                <div class="stilte">
                    <h4><?php echo htmlspecialchars($results['projects']['projects']); ?></h4>
                    <p>Projects</p>
                </div>
            </div>
            <div class="card1">
                <div class="icon"><h1><i class="fa-solid fa-scroll"></i></h1></div>
                <div class="stilte">
                    <h4><?php echo htmlspecialchars($results['reports']['reports']); ?></h4>
                    <p>No. Of Reports</p>
                </div>
            </div>
            <div class="card1">
                <div class="icon"><h1><i class="fa-solid fa-user"></i></h1></div>
                <div class="stilte">
                    <h4><?php echo htmlspecialchars($results['freelancers']['total']); ?></h4>
                    <p>No. Of Freelancers</p>
                </div>
            </div>
            <div class="card1">
                <div class="icon"><h1><i class="fa-solid fa-people-group"></i></h1></div>
                <div class="stilte">
                    <h4><?php echo htmlspecialchars($results['clients']['totalc']); ?></h4>
                    <p>No. Of Clients</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-content1 d-none" id="main-content1">
    <div class="main-heading">
        <h1>Reports Table</h1>
    </div>
    <div class="table-reports">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Client Name</th>
                    <th scope="col">Client E-mail</th>
                    <th scope="col">Report</th>
                    <th scope="col">Freelancer Name</th>
                    <th scope="col">Freelancer National ID</th>
                    <th scope="col">Freelancer E-mail</th>
                    <th scope="col">Ban</th>
                </tr>
            </thead>
            <tbody>
                <?php $nom = 1; ?>
                <?php while ($data = $run_select->fetch_assoc()) { ?>
                    <tr>
                        
                        <th scope="row"><?php echo htmlspecialchars($nom++); ?></th>
                        <td><?php echo htmlspecialchars($data['client_name']); ?></td>
                        <td><a href="mailto:<?php echo htmlspecialchars($data['client_email']); ?>"><?php echo htmlspecialchars($data['client_email']); ?></a></td>
                        <td><?php echo htmlspecialchars($data['report']); ?></td>
                        <td><?php echo htmlspecialchars($data['freelancer_name']); ?></td>
                        <td><?php echo htmlspecialchars($data['N_id']); ?></td>
                        <td><a href="mailto:<?php echo htmlspecialchars($data['freelancer_email']); ?>"><?php echo htmlspecialchars($data['freelancer_email']); ?></a></td>
                        <td><button class="btnban" type="button" onclick="showPopup(<?php echo htmlspecialchars($data['freelancer_id']); ?>)">Ban</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="main-content2 d-none" id="main-content2">
    <div class="add-admin">
        <form class="form" method="POST">
            <h1>Add New Admin</h1>
            <span class="input-span">
                <input type="text" name="admin_name" id="text" placeholder="Enter admin Name" required />
            </span>
            <span class="input-span">
                <input type="email" name="admin_email" id="email" placeholder="Enter admin E-mail" required />
                <p><?php echo htmlspecialchars($er_email); ?></p>
            </span>
            <span class="input-span">
                <input type="password" name="admin_password" id="password" placeholder="Enter admin Password" required />
            </span>
            <span class="input-span">
                <input type="password" name="confirm_pass" id="password" placeholder="Confirm admin Password" required />
            </span>
            <input class="submit" name="submit" type="submit" value="Add" />
        </form>
    </div>
</div>

<div class="main-content3 d-none" id="main-content3">
    <div class="main-heading">
        <h1>Admins</h1>
    </div>
    <div class="table-reports">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Admin Name</th>
                    <th scope="col">Admin E-mail</th>
                </tr>
            </thead>
            <tbody>
                <?php $nom1 = 1; ?>
                <?php while ($data = $run_admin->fetch_assoc()) { ?>
                    <tr>
                        <th scope="row"><?php echo htmlspecialchars($nom1++); ?></th>
                        <td><?php echo htmlspecialchars($data['admin_name']); ?></td>
                        <td><?php echo htmlspecialchars($data['admin_email']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="main-content2 d-none" id="ban">
    <div class="add-admin">
        <form class="form" method="POST">
            <h1>Ban Freelancer <i class="fa-solid fa-x" onclick="closePopup1()"></i></h1>
            <span class="input-span">
                <input id="ban1" type="hidden" name="freelancer_id">
            </span>
            <span class="input-span">
                <input type="date" name="date" id="text" placeholder="Enter current date" required />
            </span>
            <span class="input-span">
                <input type="number" name="days" id="email" placeholder="Enter ban days" required />
            </span>
            <input class="submit" name="submit1" type="submit" value="Add" />
        </form>
    </div>
</div>

<script>
    var maincontent = document.getElementById("main-content");
    var maincontent1 = document.getElementById("main-content1");
    var maincontent2 = document.getElementById("main-content2");
    var maincontent3 = document.getElementById("main-content3");
    var ban = document.getElementById("ban");
    var ban1 = document.getElementById("ban1");

    function openRep() {
        maincontent.classList.add('d-none');
        maincontent1.classList.remove('d-none');
        maincontent2.classList.add('d-none');
        maincontent3.classList.add('d-none');
    }

    function closeRep() {
        maincontent.classList.remove('d-none');
        maincontent1.classList.add('d-none');
        maincontent2.classList.add('d-none');
        maincontent3.classList.add('d-none');
    }

    function openAdd() {
        maincontent.classList.add('d-none');
        maincontent1.classList.add('d-none');
        maincontent2.classList.remove('d-none');
        maincontent3.classList.add('d-none');
    }

    function openAdm() {
        maincontent.classList.add('d-none');
        maincontent1.classList.add('d-none');
        maincontent2.classList.add('d-none');
        maincontent3.classList.remove('d-none');
    }

    function showPopup(freelancer_id) {
        ban.classList.remove('d-none');
        ban1.value = freelancer_id;
    }

    function closePopup1() {
        ban.classList.add('d-none');
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
