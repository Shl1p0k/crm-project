<?php
require 'db.php';

$id = $_GET['id'] ?? 0;

$stmt = $db->prepare("DELETE FROM clients WHERE id = :id");
$stmt->execute([':id' => $id]);

header('Location: index.php');
exit;
?>