<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $db->prepare("INSERT INTO clients (full_name, phone, email, service_type, status) 
                          VALUES (:full_name, :phone, :email, :service_type, :status)");
    $stmt->execute([
        ':full_name'    => $_POST['full_name'],
        ':phone'        => $_POST['phone'],
        ':email'        => $_POST['email'],
        ':service_type' => $_POST['service_type'],
        ':status'       => $_POST['status']
    ]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить клиента</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Добавить клиента</h1>
        
        <form method="POST">
            <label>ФИО:</label>
            <input type="text" name="full_name" required>
            
            <label>Телефон:</label>
            <input type="text" name="phone" required>
            
            <label>Email:</label>
            <input type="email" name="email" required>
            
            <label>Тип услуги:</label>
            <select name="service_type">
                <option>Кредит</option>
                <option>Ипотека</option>
                <option>Страхование жизни</option>
                <option>Страхование имущества</option>
                <option>Вклад</option>
            </select>
            
            <label>Статус:</label>
            <select name="status">
                <option>Активный</option>
                <option>Неактивный</option>
                <option>VIP</option>
            </select>
            
            <button type="submit" class="btn btn-add">Сохранить</button>
            <a href="index.php" class="btn">Отмена</a>
        </form>
    </div>
</body>
</html>