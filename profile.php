<?php
session_start();
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма регистрации</title>

    <link rel="shortcut icon" href="/img/favicon2.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    

<!-- Форма авторизации -->
<div id="img">
    <img src="img/doktornoutbukoff.svg" alt="doktornoutbukoff" width="170px">
</div>
    <div class="container">
        <div class="YellowBg">
            <div class="box signin">
                <h2>Уже есть учетная запись?</h2>
                <button class="signinBtn">Войти</button>
            </div>
            <div class="box signup">
                <h2>Нет учетной записи?</h2>
                <button class="signupBtn">Зарегистрироваться</button>
            </div>
        </div> 
        <div class="formBx">
           <div class="form signinForm">
           <form action="vendor/signin.php" method="post">
        <label class="label">Авторизация</label>
        <input type="login" name="login" placeholder="Введите свой логин">
        <input type="password" name="password" placeholder="Введите пароль">
        <input type="submit" value="Войти"> 
        <?php
            if ($_SESSION['message']) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
        
        </form>

           </div>
                <div class="form signupForm">
           <form action="vendor/signup.php" method="post" enctype="multipart/form-data">
        <label>ФИО</label>
        <input required type="text" name="full_name" placeholder="Введите свое полное имя">
        <label>Логин</label>
        <input type="text" name="login" placeholder="Введите свой логин">
        <label>Почта</label>
        <input type="email" name="email" placeholder="Введите адрес своей почты">
        <label>Изображение профиля</label>
        <input type="file" name="avatar">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введите пароль">
        <label>Подтверждение пароля</label>
        <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
        <input type="submit" value="Отправить">
        <?php
            if ($_SESSION['message']) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
            </div>
            
            </form>
        </div>   
    </div>

    <script>
        const signinBtn = document.querySelector('.signinBtn');
        const signupBtn = document.querySelector('.signupBtn');
        const formBx = document.querySelector('.formBx');
        const body = document.querySelector('body')

        signupBtn.onclick = function(){
            formBx.classList.add('active')
            body.classList.add('active')    
        }

        signinBtn.onclick = function(){
            formBx.classList.remove('active')  
            body.classList.remove('active')  
        }
    </script>
        
</body>
</html>