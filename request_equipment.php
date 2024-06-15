<?php
session_start();
if ($_SESSION['role'] != 'Coordinator') {
    header('Location: dashboard.php');
    exit;
}

// Connection to the database
$conn = new PDO('mysql:host=localhost;dbname=inventory_management', 'root', '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $coordinator_id = $_SESSION['user_id'];
    $equipment_id = $_POST['equipment_id'];

    $stmt = $conn->prepare('INSERT INTO requests (coordinator_id, equipment_id) VALUES (?, ?)');
    $stmt->execute([$coordinator_id, $equipment_id]);

    echo 'Request submitted successfully!';
}

// Fetch equipment list
$stmt = $conn->query('SELECT * FROM equipment');
$equipment = $stmt->fetchAll();
?>

<form method="post" action="request_equipment.php">
    Equipment:
    <select name="equipment_id">
        <?php foreach ($equipment as $item): ?>
        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
        <?php endforeach; ?>
    </select><br>
    <input type="submit" value="Request Equipment">
</form>
