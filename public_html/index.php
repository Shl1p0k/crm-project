<?php
require 'db.php';

$stmt = $db->query("SELECT * FROM clients ORDER BY created_at DESC");
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>CRM - Управление клиентами</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Система управления клиентами</h1>
        <p class="subtitle">Сектор услуг: банки, страховые компании</p>
        
        <a href="add.php" class="btn btn-add">+ Добавить клиента</a>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ФИО</th>
                    <th>Телефон</th>
                    <th>Email</th>
                    <th>Услуга</th>
                    <th>Статус</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($clients)): ?>
                    <tr><td colspan="8" class="empty">Клиентов пока нет</td></tr>
                <?php else: ?>
                    <?php foreach ($clients as $c): ?>
                    <tr>
                        <td><?= $c['id'] ?></td>
                        <td><?= htmlspecialchars($c['full_name']) ?></td>
                        <td><?= htmlspecialchars($c['phone']) ?></td>
                        <td><?= htmlspecialchars($c['email']) ?></td>
                        <td><?= htmlspecialchars($c['service_type']) ?></td>
                        <td><span class="status"><?= htmlspecialchars($c['status']) ?></span></td>
                        <td><?= $c['created_at'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $c['id'] ?>" class="btn btn-edit">✎</a>
                            <a href="delete.php?id=<?= $c['id'] ?>" class="btn btn-del" onclick="return confirm('Удалить клиента?')">✕</a>
                            <a href="send.php?id=<?= $c['id'] ?>" class="btn btn-mail">✉</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>