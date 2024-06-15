<?php
session_start();
if ($_SESSION['role'] != 'HoD') {
    header('Location: dashboard.php');
    exit;
}

// Connection to the database
$conn = new PDO('mysql:host=localhost;dbname=inventory_management', 'root', '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request_id = $_POST['request_id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare('UPDATE requests SET status = ? WHERE id = ?');
    $stmt->execute([$status, $request_id]);

    echo 'Request status updated successfully!';
}

// Fetch requests
$stmt = $conn->query('SELECT requests.id, users.username, equipment.name, requests.status
                      FROM requests
                      JOIN users ON requests.coordinator_id = users.id
                      JOIN equipment ON requests.equipment_id = equipment.id');
$requests = $stmt->fetchAll();
?>

<h2>Approve Requests</h2>
<form method="post" action="approve_requests.php">
    <table border="1">
        <tr>
            <th>Request ID</th>
            <th>Coordinator</th>
            <th>Equipment</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php foreach ($requests as $request): ?>
        <tr>
            <td><?= $request['id'] ?></td>
            <td><?= $request['username'] ?></td>
            <td><?= $request['name'] ?></td>
            <td><?= $request['status'] ?></td>
            <td>
                <input type="hidden" name="request_id" value="<?= $request['id'] ?>">
                <select name="status">
                    <option value="Pending" <?= $request['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Approved" <?= $request['status'] == 'Approved' ? 'selected' : '' ?>>Approved</option>
                    <option value="Denied" <?= $request['status'] == 'Denied' ? 'selected' : '' ?>>Denied</option>
                </select>
                <input type="submit" value="Update Status">
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</form>
