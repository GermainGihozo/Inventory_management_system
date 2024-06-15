<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Dashboard</h1>
            <ul>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header>
    <div class="container">
        <?php
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit;
        }

        echo 'Welcome, ' . $_SESSION['role'] . '<br>';

        if ($_SESSION['role'] == 'Logistic Officer') {
            echo '<a href="register_equipment.php">Register New Equipment</a><br>';
        } elseif ($_SESSION['role'] == 'Coordinator') {
            echo '<a href="request_equipment.php">Request New Equipment</a><br>';
            echo '<a href="view_equipment.php">View Equipment</a><br>';
        } elseif ($_SESSION['role'] == 'HoD') {
            echo '<a href="approve_requests.php">Approve Requests</a><br>';
        }

        echo '<a href="change_password.php">Change Password</a><br>';
        ?>
    </div>
    <script src="js/script.js"></script>
</body>
</html>

