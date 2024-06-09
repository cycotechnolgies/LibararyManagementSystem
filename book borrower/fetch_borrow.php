<?php
include 'config.php';

$sql = "SELECT * FROM bookborrower";
$stmt = $pdo->query($sql);

$borrowDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($borrowDetails);
?>
