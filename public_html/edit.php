<?php
require 'db.php';

$id = $_GET['id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $db->prepare("UPDATE clients SET full_name=:full_name, phone=:phone, 
                          email=:email, service_type=:service_type, status=:status WHERE id=:id");
    $stmt->execute([
        ':full_name'    => $_POST['full_name'],
        ':phone'        => $_POST['phone'],
        ':email'        => $_POST['email'],
        ':service_type' => $_POST['service_type'],
        ':status'       => $_POST['status'],
        ':id'           => $id
    ]);
    header('Location: index.php');
    exit;
}

$stmt = $db->prepare("SELECT * FROM clients WHERE id = :id");
$stmt->execute([':id' => $id]);
$client = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$client) {
    die("Клиент не найден");
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать клиента</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Редактировать клиента #<?= $client['id'] ?></h1>
        
        <form method="POST">
            <label>ФИО:</label>
            <input type="text" name="full_name" value="<?= htmlspecialchars($client['full_name']) ?>" required>
            
            <label>Телефон:</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($client['phone']) ?>" required>
            
            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($client['email']) ?>" required>
            
            <label>Тип услуги:</label>
            <select name="service_type">
                <?php foreach (['Кредит','Ипотека','Страхование жизни','Страхование имущества','Вклад'] as $s): ?>
                    <option <?= $client['service_type'] === $s ? 'selected' : '' ?>><?= $s ?></option>
                <?php endforeach; ?>
            </select>
            
            <label>Статус:</label>
            <select name="status">
                <?php foreach (['Активный','Неактивный','VIP'] as $s): ?>
                    <option <?= $client['status'] === $s ? 'selected' : '' ?>><?= $s ?></option>
                <?php endforeach; ?>
            </select>
            
            <button type="submit" class="btn btn-edit">Обновить</button>
            <a href="index.php" class="btn">Отмена</a>
        </form>
    </div>
</body>
</html>