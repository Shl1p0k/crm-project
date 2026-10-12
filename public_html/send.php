<?php
require 'db.php';

$id = $_GET['id'] ?? 0;
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    $to = $_POST['email'];
    
    $message = "Письмо для $to отправлено! (имитация)";
}

$stmt = $db->prepare("SELECT * FROM clients WHERE id = :id");
$stmt->execute([':id' => $id]);
$client = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отправить email</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Отправить email клиенту</h1>
        <p>Клиент: <b><?= htmlspecialchars($client['full_name']) ?></b> (<?= $client['email'] ?>)</p>
        
        <?php if ($message): ?>
            <p class="success"><?= $message ?></p>
        <?php endif; ?>
        
        <form method="POST">
            <input type="hidden" name="email" value="<?= $client['email'] ?>">
            
            <label>Тема:</label>
            <input type="text" name="subject" required>
            
            <label>Сообщение:</label>
            <textarea name="body" rows="5" required></textarea>
            
            <button type="submit" class="btn btn-mail">Отправить</button>
            <a href="index.php" class="btn">Отмена</a>
        </form>
    </div>
</body>
</html>