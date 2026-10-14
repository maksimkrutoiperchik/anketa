<?php
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $age = trim($_POST['age'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $food = trim($_POST['food'] ?? '');
    $clothing = trim($_POST['clothing'] ?? '');
    $music = trim($_POST['music'] ?? '');
    $hobby = trim($_POST['hobby'] ?? '');

    $music_lower = mb_strtolower($music, 'UTF-8');

    if (preg_match('/(kai\s*angel|ка[йй@]\s*энжел|ка[йй@]\s*ангел)/ui', $music_lower)) {
        $error = 'ну не';
    } elseif (empty($login) || empty($password) || empty($name) || empty($age) || empty($gender)) {
        $error = 'Пожалуйста, заполните все обязательные поля.';
    } elseif (!is_numeric($age) || $age < 1 || $age > 120) {
        $error = 'Введите корректный возраст (число от 1 до 120).';
    } else {
        $expire = time() + 604800; // сохранение куки на 7 дней
        setcookie('user_login', $login, $expire, '/');
        setcookie('user_password', $password, $expire, '/');
        setcookie('user_name', $name, $expire, '/');
        setcookie('user_age', $age, $expire, '/');
        setcookie('user_gender', $gender, $expire, '/');
        setcookie('user_food', $food, $expire, '/');
        setcookie('user_clothing', $clothing, $expire, '/');
        setcookie('user_music', $music, $expire, '/');
        setcookie('user_hobby', $hobby, $expire, '/');

        $message = 'Регистрация прошла успешно! Теперь вы можете войти.';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Регистрация</h1>

        <?php if (!empty($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (!empty($message)): ?>
            <div class="success">
                <?php echo htmlspecialchars($message); ?>
                <div class="links" style="margin-top: 10px;">
                    <a href="login.php">Перейти на страницу входа</a>
                </div>
            </div>
        <?php else: ?>

        <form action="register.php" method="POST">
            <h3>Данные для входа</h3>
            <label for="login">Логин *</label>
            <input type="text" id="login" name="login" value="<?php echo htmlspecialchars($_POST['login'] ?? ''); ?>" required>

            <label for="password">Пароль *</label>
            <input type="password" id="password" name="password" required>

            <h3>Личная информация</h3>
            <label for="name">Имя *</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>

            <label for="age">Возраст *</label>
            <input type="number" id="age" name="age" min="1" max="120" value="<?php echo htmlspecialchars($_POST['age'] ?? ''); ?>" required>

            <label for="gender">Пол *</label>
            <select id="gender" name="gender" required>
                <option value="">Выберите пол</option>
                <option value="Мужской" <?php echo (($_POST['gender'] ?? '') === 'Мужской') ? 'selected' : ''; ?>>Мужской</option>
                <option value="Женский" <?php echo (($_POST['gender'] ?? '') === 'Женский') ? 'selected' : ''; ?>>Женский</option>
            </select>

            <label for="food">Предпочтения в еде</label>
            <select id="food" name="food">
                <option value="Всеядный">Всеядный</option>
                <option value="Вегетарианское">Вегетарианское</option>
                <option value="Веганское">Веганское</option>
                <option value="Кето">Кето</option>
            </select>

            <label for="clothing">Стиль одежды</label>
            <select id="clothing" name="clothing">
                <option value="Повседневный (Casual)">Повседневный (Casual)</option>
                <option value="Деловой (Business)">Деловой (Business)</option>
                <option value="Спортивный (Sport)">Спортивный (Sport)</option>
                <option value="Уличный (Streetwear)">Уличный (Streetwear)</option>
            </select>

            <label for="music">Любимое музыкальное направление</label>
            <input type="text" id="music" name="music" placeholder="Например: Рок, Поп, Хип-хоп" value="<?php echo htmlspecialchars($_POST['music'] ?? ''); ?>">

            <label for="hobby">Хобби или увлечения</label>
            <input type="text" id="hobby" name="hobby" placeholder="Например: Фотография, Книги" value="<?php echo htmlspecialchars($_POST['hobby'] ?? ''); ?>">

            <button type="submit">Зарегистрироваться</button>
        </form>

        <div class="links">
            <p>Уже зарегистрированы? <a href="login.php">Войти</a></p>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>