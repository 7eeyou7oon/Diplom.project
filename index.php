<?php
session_start();

$successMessage = "";
$errorMessage = "";

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    &&
    isset($_POST['отправить'])
) {

    // Подключение к базе данных
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "bd";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    // Получение данных из формы
    $name = $_POST['имя'] ?? '';
    $full_name = $_POST['фамилия'] ?? '';
    $email = $_POST['почта'] ?? '';
    $telephone = $_POST['телефон'] ?? '';
    $message = $_POST['сообщение'] ?? '';

    // Защита от SQL-инъекций
    $name = mysqli_real_escape_string($conn, $name);
    $full_name = mysqli_real_escape_string($conn, $full_name);
    $email = mysqli_real_escape_string($conn, $email);
    $telephone = mysqli_real_escape_string($conn, $telephone);
    $message = mysqli_real_escape_string($conn, $message);

    // SQL-запрос
    $sql = "INSERT INTO contacts (name, full_name, email, telephone, message)
            VALUES ('$name', '$full_name', '$email', '$telephone', '$message')";

    if (mysqli_query($conn, $sql)) {
        $successMessage = "Вы успешно отправили заявку!";
    } else {
        $errorMessage = "Ошибка отправки формы.";
    }

    mysqli_close($conn);
}
?>

<!doctype html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="/img/favicon2.ico" type="image/x-icon">
    <title>Доктор ноутбукoff</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media.css">
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="header__wrapper">
                <div class="header__block">
                    <a href="/" class="header__logo">
                        <img src="img/logo 1.png" alt="Доктор ноутбукoff">
                    </a>
                </div>
                <nav class="nav">
                    <a href="#services" class="nav__link active">Наши услуги</a>
                    <a href="#prices" class="nav__link">Цены</a>
                    <a href="#about" class="nav__link">О нас</a>
                    <a href="#contacts" class="nav__link">Контакты</a>
                </nav>
                <div class="header__block">

                    <?php if (!empty($_SESSION['user'])): ?>

                    <div class="profile-menu-wrapper">

                        <div class="header-profile" onclick="toggleProfileMenu()">

                            <img src="<?= $_SESSION['user']['avatar'] ?>" class="header-avatar">

                            <span class="header-login">
                                <?= $_SESSION['user']['login'] ?>
                            </span>

                        </div>

                        <div class="profile-dropdown" id="profileDropdown">

                            <button onclick="openFavorites()">

                                Выбранные услуги

                            </button>

                            <a href="#contacts">

                                Оформить заявку

                            </a>

                            <a href="vendor/logout.php">

                                Выйти

                            </a>

                        </div>

                    </div>

                    <?php else: ?>

                    <div class="header__button">

                        <a href="/profile.php" class="header__button-link login">
                            Войти
                        </a>

                        <a href="/profile.php" class="header__button-link register">
                            Регистрация
                        </a>
                    </div>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </header>


    <section class="intro">
        <div class="container">
            <div class="intro__content">
                <div class="intro__block">
                    <h1 class="intro__title">
                        Быстрый и надежный ремонт компьютеров и ноутбуков
                    </h1>

                    <a href="#about" class="btn">
                        больше
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="info">
        <div class="container">
            <div class="wrapper">
                <div class="block">
                    <div class="info__item">
                        <div class="info__img">
                            <img src="img/phone.svg" alt="">
                        </div>
                        <h4 class="info__title">
                            Позвонить +7 (747) 777-61-90
                        </h4>
                        <p class="info__text">
                            Бесплатный звонок нам
                        </p>
                    </div>
                </div>

                <div class="block">
                    <div class="info__item">
                        <div class="info__img">
                            <img src="img/calendar.svg" alt="">
                        </div>
                        <h4 class="info__title">
                            Оставить заявку
                        </h4>
                        <p class="info__text">
                            Бесплатная диагностика
                        </p>
                    </div>
                </div>

                <div class="block">
                    
                        <div class="info__item">
                            <div class="info__img">
                                <a href="https://2gis.kz/pavlodar/firm/70000001018639188/76.936811%2C52.27856?floor=1&m=76.93688%2C52.278468%2F18.65"
                        target="_blank" style="text-decoration:none;color:inherit;">
                                <img src="img/pin.svg" alt="">
                                </a>
                            </div>
                            <h4 class="info__title">
                                Мы на карте
                            </h4>
                            <p class="info__text">
                                Г.Павлодар, Ак.Сатпаева 27
                            </p>

                        </div>
                    
                </div>

            </div>

        </div>

    </section>


    <section class="section" id="services">
        <div class="container">
            <h2 class="block__title">
                СЕРВИС
            </h2>
            <a href="#prices" class="block__link">
                ПОСМОТРЕТЬ ВСЕ УСЛУГИ
            </a>

            <div class="wrapper">
                <div class="block">
                    <a href="favorite_service.php?service=Техника/Периферия" class="services__item">

                        <div class="services__content" style="background-image: url('img/diagnostic.jpg');">

                            <div class="services__content-item">

                                <div class="services__img">
                                    <img src="img/plus.svg" alt="">
                                </div>

                                <p class="services__text">
                                    Продажа ноутбуков, комплектующих,
                                    аксессуаров и компьютерной периферии
                                </p>

                            </div>

                        </div>

                        <h3 class="services__title">
                            Техника / Периферия
                        </h3>

                    </a>
                </div>


                <div class="block">
                    <a href="favorite_service.php?service=Чистка" class="services__item">
                        <div class="services__content" style="background-image:url('img/tires.jpg');">
                            <div class="services__content-item">
                                <div class="services__img">
                                    <img src="img/plus.svg" alt="">
                                </div>
                                <p class="services__text">
                                    Профессиональная чистка ноутбуков и компьютеров. Бесплатная диагностика техники.
                                </p>
                            </div>
                        </div>
                        <h3 class="services__title">
                            Чистка
                        </h3>
                    </a>
                </div>


                <div class="block">
                    <a href="favorite_service.php?service=Ремонт" class="services__item">
                        <div class="services__content" style="background-image:url('img/engine.jpg');">
                            <div class="services__content-item">
                                <div class="services__img">
                                    <img src="img/plus.svg" alt="">
                                </div>
                                <p class="services__text">
                                    Наши опытные техники проводят качественный ремонт и замену неисправных компонентов
                                </p>
                            </div>
                        </div>
                        <h3 class="services__title">
                            Ремонт
                        </h3>
                    </a>
                </div>
            </div>
        </div>

    </section>

    <section class="about" id="prices">

        <div class="container">

            <div class="about__wrapper">

                <div class="about__block">

                    <h2 class="about__title">
                        ПРАЙС-ЛИСТ ЦЕН
                    </h2>

                    <p class="about__subtitle">
                        НА МАЛУЮ ЧАСТЬ НАШИХ УСЛУГ
                    </p>

                    <div class="price-card">

                        <table class="about__table">

                            <tr>
                                <th>УСЛУГА / ТОВАР</th>
                                <th>ЦЕНА</th>
                            </tr>

                            <tr>
                                <td class="service-name">
                                    <img src="img/laptop-check.svg" alt="" class="service-icon"><span>
                                        Ремонт ноутбуков
                                    </span>
                                </td>
                                <td>от 10 000 тг</td>
                            </tr>

                            <tr>
                                <td class="service-name">
                                    <img src="img/clean.svg" alt="" class="service-icon"><span>
                                        Чистка ПК
                                    </span>
                                </td>
                                <td>2 000 тг</td>
                            </tr>

                            <tr>
                                <td class="service-name">
                                    <img src="img/diagnostics.svg" alt="" class="service-icon"><span>
                                        Диагностика
                                    </span>
                                </td>
                                <td>Бесплатно при ремонте</td>
                            </tr>

                            <tr>
                                <td class="service-name">
                                    <img src="img/trade-in.svg" alt="" class="service-icon"><span>
                                        TRADE-IN ноутбуков
                                    </span>
                                </td>
                                <td>Индивидуальная оценка</td>
                            </tr>

                            <tr>
                                <td class="service-name">
                                    <img src="img/buyback.svg" alt="" class="service-icon"><span>
                                        Выкуп ноутбуков
                                    </span>
                                </td>
                                <td>Цена зависит от состояния</td>
                            </tr>

                            <tr>
                                <td class="service-name">
                                    <img src="img/exchange.svg" alt="" class="service-icon"><span>
                                        Обмен ноутбуков
                                    </span>
                                </td>
                                <td>20 000 – 150 000 тг</td>
                            </tr>

                            <tr>
                                <td class="service-name">
                                    <img src="img/system.svg" alt="" class="service-icon"><span>
                                        Системные блоки
                                    </span>
                                </td>
                                <td>от 30 000 тг</td>
                            </tr>

                            <tr>
                                <td class="service-name">
                                    <img src="img/monitor.svg" alt="" class="service-icon"><span>
                                        Мониторы
                                    </span>
                                </td>
                                <td>от 5 000 тг</td>
                            </tr>

                            <tr>
                                <td class="service-name">
                                    <img src="img/charger.svg" alt="" class="service-icon"><span>
                                        Зарядные устройства
                                    </span>
                                </td>
                                <td>от 6 000 тг</td>
                            </tr>

                            <tr>
                                <td class="service-name">
                                    <img src="img/laptop.svg" alt="" class="service-icon"><span>
                                        Ноутбуки
                                    </span>
                                </td>
                                <td>от 39 000 тг</td>
                            </tr>

                            <tr>
                                <td class="service-name">
                                    <img src="img/printer.svg" alt="" class="service-icon"><span>
                                        Заправка принтеров
                                    </span>
                                </td>
                                <td>1 500 тг</td>
                            </tr>

                            <tr>
                                <td class="service-name">
                                    <img src="img/mfu.svg" alt="" class="service-icon"><span>
                                        Принтеры / МФУ
                                    </span>
                                </td>
                                <td>от 25 000 тг</td>
                            </tr>

                        </table>

                    </div>

                    <a href="#services" class="order-link">
                        Оформить заказ
                    </a>

                </div>

            </div>

        </div>

        </div>

    </section>

    <section class="section process" id="about">
        <div class="container">
            <h2 class="process__title">БЫСТРО И ПРОСТО</h2>
            <h3 class="process__subtitle">наш рабочий процесс</h3>

            <div class="wrapper">
                <div class="block">
                    <div class="process__item">
                        <h4 class="info__title">1.Прием и диагностика</h4>
                        <p class="info__text">
                            Мы проводим детальный прием и записываем все ваши заявки и особые требования.
                        </p>
                    </div>
                </div>
                <div class="block">
                    <div class="process__item">
                        <h4 class="info__title">02. Ремонт и замена компонентов
                        </h4>
                        <p class="info__text">
                            Проводим качественный ремонт и замену неисправных компонентов, используя только
                            высококачественные запчасти.
                        </p>
                    </div>
                </div>
                <div class="block">
                    <div class="process__item">
                        <h4 class="info__title">03. Тестирование и качество</h4>
                        <p class="info__text">
                            Проверяем работу аппаратных и программных компонентов, а также производительность системы.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="contacts" id="contacts">
        <div class="container">
            <h2 class="block__title text-white">
                Связаться с нами
            </h2>
            <form class="contacts__form" id="contactForm">

                <div class="form__row">

                    <div class="form__group">

                        <input type="text" class="input" name="name" id="name" placeholder=" " required
                            autocomplete="name">

                        <label for="name" class="label">
                            Имя
                        </label>

                    </div>

                    <div class="form__group">

                        <input type="text" class="input" name="surname" id="surname" placeholder=" "
                            autocomplete="family-name">

                        <label for="surname" class="label">
                            Фамилия
                        </label>

                    </div>

                </div>

                <div class="form__row">

                    <div class="form__group">

                        <input type="email" class="input" name="email" id="email" placeholder=" " required
                            autocomplete="email">

                        <label for="email" class="label">
                            Почта
                        </label>

                    </div>

                    <div class="form__group">

                        <input type="tel" class="input" name="phone" id="phone" placeholder=" " required
                            autocomplete="tel">

                        <label for="phone" class="label">
                            Телефон
                        </label>

                    </div>

                </div>

                <!-- УСЛУГА -->

                <div class="form__row">

                    <div class="form__group">

                        <input type="text" class="input" name="service" id="service" placeholder=" ">

                        <label for="service" class="label">
                            Услуга / Товар
                        </label>

                    </div>

                </div>

                <!-- СООБЩЕНИЕ -->

                <div class="form__row">

                    <div class="form__group">

                        <textarea class="textarea" name="message" id="message"
                            placeholder="можете указать марку и модель ноутбука"></textarea>

                        <label for="message" class="label">
                            Сообщение
                        </label>

                    </div>

                </div>

                <!-- BUTTON -->

                <button class="btn text-upper" type="submit" name="send">
                    Отправить заявку
                </button>

                <!-- SUCCESS -->

                <?php if (isset($successMessage)) : ?>

                <p class="success-message">
                    <?php echo $successMessage; ?>
                </p>

                <?php endif; ?>

                <!-- ERROR -->

                <?php if (isset($errorMessage)) : ?>

                <p class="error-message">
                    <?php echo $errorMessage; ?>
                </p>

                <?php endif; ?>

                <div class="form-result" id="formResult"></div>
            </form>
        </div>
    </section>


    <footer class="footer">
        <div class="container">
            <div class="footer__wrapper">
                <p class="copyright">
                    © 2026 Сервисный центр ДокторНоутбукоff
                </p>
                <div class="footer__soc">
                    <a href="https://api.whatsapp.com/send/?phone=77010530500&text=Здравствуйте! Пишу Вам с сайта"
                        target="_blank" class="footer__soc-link">
                        <img src="img/whatsapp.svg" alt="">
                    </a>
                    <a href="https://www.threads.com/@doctor_noutbukoff" target="_blank" class="footer__soc-link">
                        <img src="img/Threads.svg" alt="">
                    </a>
                    <a href="https://www.instagram.com/doctor_noutbukoff?igsh=eXdvc3d1bXFiamNi" target="_blank"
                        class="footer__soc-link">
                        <img src="img/instagram.svg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <?php if (!empty($_SESSION['user'])): ?>

    <div class="favorites-modal" id="favoritesModal">

        <div class="favorites-content">

            <div class="favorites-header">

                <h2>
                    Выбранные услуги
                </h2>

                <button type="button" class="close-modal" onclick="closeFavorites()">

                    ×

                </button>

            </div>

            <?php

                require_once 'vendor/connect.php';

                $user_id = $_SESSION['user']['id'];

                $favorites = mysqli_query(
                    $connect,
                    "SELECT * FROM favorite_services
             WHERE user_id='$user_id'"
                );

                while ($favorite = mysqli_fetch_assoc($favorites)):

                ?>

            <div class="favorite-service">

                <div class="favorite-service-left">

                    <div class="favorite-icon">

                        <?php if ($favorite['service_name'] == 'Чистка'): ?>

                        🧹

                        <?php elseif ($favorite['service_name'] == 'Техника/Периферия'): ?>

                        🩺

                        <?php else: ?>

                        🛠

                        <?php endif; ?>

                    </div>

                    <div class="favorite-info">

                        <h3>
                            <?= $favorite['service_name'] ?>
                        </h3>

                        <p>

                            <?php if ($favorite['service_name'] == 'Чистка'): ?>

                            Профессиональная чистка ноутбуков и компьютеров. Бесплатная диагностика техники при
                            дальнейшем ремонте.

                            <?php elseif ($favorite['service_name'] == 'Техника/Периферия'): ?>

                            Продажа ноутбуков, мониторов, зарядных устройств,
                            принтеров, комплектующих и компьютерной периферии.

                            <?php else: ?>

                            Ремонт любой сложности с гарантией качества

                            <?php endif; ?>

                        </p>

                    </div>

                </div>

                <div class="favorite-buttons">

                    <button class="remove-service" onclick="removeFavorite(<?= $favorite['id'] ?>, this)">

                        Удалить

                    </button>

                    <a href="https://api.whatsapp.com/send/?phone=77010530500&text=Здравствуйте! Меня интересует услуга: <?= urlencode($favorite['service_name']) ?>"
                        target="_blank">

                        WhatsApp

                    </a>

                    <a href="#contacts" onclick="closeFavorites()">

                        Оформить

                    </a>

                </div>

            </div>

            <?php endwhile; ?>

        </div>

    </div>

    <?php endif; ?>

    <script>
    function toggleProfileMenu() {

        const dropdown =
            document.getElementById('profileDropdown');

        dropdown.classList.toggle('active');

    }

    function openFavorites() {

        const modal =
            document.getElementById('favoritesModal');

        modal.classList.add('active');

    }

    function closeFavorites() {

        const modal =
            document.getElementById('favoritesModal');

        modal.classList.remove('active');

    }

    document.addEventListener('click', function(e) {

        const profileMenu =
            document.querySelector('.profile-menu-wrapper');

        const dropdown =
            document.getElementById('profileDropdown');

        if (
            profileMenu &&
            !profileMenu.contains(e.target)
        ) {
            dropdown.classList.remove('active');
        }

    });

    window.onclick = function(event) {

        const modal =
            document.getElementById('favoritesModal');

        if (event.target === modal) {

            modal.classList.remove('active');

        }

    }

    function removeFavorite(id, button) {

        fetch('remove_favorite.php', {

                method: 'POST',

                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },

                body: 'id=' + id

            })

            .then(response => response.text())

            .then(data => {

                if (data === 'success') {

                    const card =
                        button.closest('.favorite-service');

                    card.style.opacity = '0';

                    card.style.transform = 'translateX(40px)';

                    setTimeout(() => {

                        card.remove();

                    }, 300);

                }

            });

    };

    const form =
        document.getElementById('contactForm');

    const resultBlock =
        document.getElementById('formResult');

    form.addEventListener('submit', async function(e) {

        e.preventDefault();

        const formData = new FormData(form);

        try {

            const response = await fetch(
                'create_order.php', {
                    method: 'POST',
                    body: formData
                }
            );

            const result = await response.text();

            resultBlock.innerHTML =
                '✅ Заявка успешно отправлена!<br>Мы свяжемся с вами в ближайшее время.';

            resultBlock.className =
                'form-result success';

            form.reset();

        } catch (error) {

            resultBlock.innerHTML =
                '❌ Ошибка отправки заявки';

            resultBlock.className =
                'form-result error';
        }

    });
    </script>

</body>

</html>