<?php
session_start();
if ($_SESSION['role'] != 'Logistic Officer') {
    header('Location: dashboard.php');
    exit;
}

// Connection to the database
$conn = new PDO('mysql:host=localhost;dbname=inventory_management', 'root', '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $stmt = $conn->prepare('INSERT INTO equipment (name, description) VALUES (?, ?)');
    $stmt->execute([$name, $description]);

    echo 'Equipment registered successfully!';
}
?>

<form method="post" action="register_equipment.php">
    Name: <input type="text" name="name" required><br>
    Description: <textarea name="description"></textarea><br>
    <input type="submit" value="Register Equipment">
</form>
