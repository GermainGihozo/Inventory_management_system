<?php
// Connection to the database
$conn = new PDO('mysql:host=localhost;dbname=inventory_management', 'root', '');

// Register a new user
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $stmt = $conn->prepare('INSERT INTO users (username, password, role) VALUES (?, ?, ?)');
    $stmt->execute([$username, $password, $role]);
    header('Location: login.php');
    echo 'User registered successfully!';
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Register</h1>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </div>
    </header>
    <div class="container">
     
<form method="post" action="register.php">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Role: 
    <select name="role">
        <option value="Logistic Officer">Logistic Officer</option>
        <option value="Coordinator">Coordinator</option>
        <option value="HoD">HoD</option>
    </select><br>
    <input type="submit" value="Register">
</form>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
