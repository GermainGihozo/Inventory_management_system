<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Change Password</h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
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

        // Connection to the database
        $conn = new PDO('mysql:host=localhost;dbname=inventory_management', 'root', '');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_SESSION['user_id'];
            $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

            $stmt = $conn->prepare('UPDATE users SET password = ? WHERE id = ?');
            $stmt->execute([$new_password, $user_id]);

            echo 'Password changed successfully!';
        }
        ?>

        <form method="post" action="change_password.php" class="change-password-form">
            New Password: <input type="password" name="new_password" required><br>
            <input type="submit" value="Change Password">
        </form>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
