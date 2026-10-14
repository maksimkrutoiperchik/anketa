<?php
session_start();

$is_authorized = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true;

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php if (!$is_authorized): ?>
            <h2>Доступ ограничен</h2>
            <p>Вы не авторизованы. Пожалуйста, войдите в систему, чтобы просмотреть свою анкету.</p>
            <div class="links">
                <a href="login.php" class="btn">Перейти на страницу входа</a>
            </div>
        <?php else: ?>
            <h2>Моя анкета</h2>
            
            <div class="profile-info">
                <p><strong>Имя:</strong> <?php echo htmlspecialchars($_COOKIE['user_name'] ?? 'Не указано'); ?></p>
                <p><strong>Возраст:</strong> <?php echo htmlspecialchars($_COOKIE['user_age'] ?? 'Не указано'); ?> лет</p>
                <p><strong>Пол:</strong> <?php echo htmlspecialchars($_COOKIE['user_gender'] ?? 'Не указано'); ?></p>
                <p><strong>Предпочтения в еде:</strong> <?php echo htmlspecialchars($_COOKIE['user_food'] ?? 'Не указано'); ?></p>
                <p><strong>Стиль одежды:</strong> <?php echo htmlspecialchars($_COOKIE['user_clothing'] ?? 'Не указано'); ?></p>
                <p><strong>Любимая музыка:</strong> <?php echo htmlspecialchars($_COOKIE['user_music'] ?? 'Не указано'); ?></p>
                <p><strong>Хобби:</strong> <?php echo htmlspecialchars($_COOKIE['user_hobby'] ?? 'Не указано'); ?></p>
            </div>

            <form action="profile.php" method="POST">
                <button type="submit" name="logout" class="btn btn-danger">Выйти</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>