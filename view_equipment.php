<?php
session_start();
if ($_SESSION['role'] != 'Coordinator') {
    header('Location: dashboard.php');
    exit;
}

// Connection to the database
$conn = new PDO('mysql:host=localhost;dbname=inventory_management', 'root', '');

// Pagination settings
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Fetch equipment list
$stmt = $conn->prepare('SELECT * FROM equipment LIMIT ?, ?');
$stmt->bindParam(1, $start, PDO::PARAM_INT);
$stmt->bindParam(2, $limit, PDO::PARAM_INT);
$stmt->execute();
$equipment = $stmt->fetchAll();

// Fetch total number of records
$total_stmt = $conn->query('SELECT COUNT(*) FROM equipment');
$total_records = $total_stmt->fetchColumn();
$total_pages = ceil($total_records / $limit);
?>

<h2>Equipment List</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Date Added</th>
    </tr>
    <?php foreach ($equipment as $item): ?>
    <tr>
        <td><?= $item['id'] ?></td>
        <td><?= $item['name'] ?></td>
        <td><?= $item['description'] ?></td>
        <td><?= $item['date_added'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<!-- Pagination -->
<?php for ($i = 1; $i <= $total_pages; $i++): ?>
    <a href="?page=<?= $i ?>"><?= $i ?></a>
<?php endfor; ?>
