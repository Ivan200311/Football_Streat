<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= $style ?>">
    <title>Document</title>
</head>

<body class="body-header">
    <div>
        <nav class="head-header">
            <ul class="city">
                <li><img src="/upload/Карта_России_на_круглом_флаге.svg.png" width="40" alt=""></li>
                <li><select class="select-city">
                        <option value="">Челябинск</option>
                        <option value="">Оренбург</option>
                        <option value="">Санкт-Петербург</option>
                    </select></li>
            </ul>
            <ul class="label">
                <li class="name-store"><a class="name-a-store" href="/index.php">FootballStreat.ru</a></li>

            </ul>
            <ul class="phone">
                <li class="img-phone"><img class="img-phone-img" src="/upload/490219e137ca21f8c789278424e4693a.png" width="20" alt=""></li>
                <li class="number-phone">8-800-500-40-20</li>
            </ul>
        </nav>
        <nav class="name-footballStore">

            <div class="grid">
                <div>
                    <ul class="sections-position">
                        <a class="a-head" href="/app/tables/products/boots.php">
                            <li>Бутсы</li>
                        </a>
                        <a class="a-head" href="/app/tables/products/kipa.php">
                            <li>Экипировка</li>
                        </a>
                        <a class="a-head" href="/app/tables/products/delivery address.php">
                            <li>Доставка и оплата</li>
                        </a>
                        <a class="a-head" href="/app/tables/aboutUs.php">
                            <li>О нас</li>
                        </a>
                    </ul>
                    <ul class="sections-position-mobile">
                        <p>
                            <a class="btn btn-burger" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Меню
                            </a>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <a class="a-head" href="/app/tables/products/boots.php">
                                    <li>Бутсы</li>
                                </a>
                                <a class="a-head" href="/app/tables/products/kipa.php">
                                    <li>Экипировка</li>
                                </a>
                                <a class="a-head" href="/app/tables/products/delivery address.php">
                                    <li>Доставка и оплата</li>
                                </a>
                                <a class="a-head" href="/app/tables/aboutUs.php">
                                    <li>О нас</li>
                                </a>
                            </div>
                        </div>
                    </ul>
                </div>

                <form class="form-search" action="/app/tables/products/search.php" method="POST">
                    <li class="search">
                        <input type="text" name="name" class="search-stroka" placeholder="Поиск...">
                        <button class="lypa" name="submit"><img src="/upload/header (2).png" width="20" alt=""></button>
                    </li>
                </form>





                <div class="img-header">
                    <div class="img-header-div">
                        <?php if (!isset($_SESSION['auth']) || !$_SESSION['auth']) : ?>
                            <a href="/app/tables/users/auth.php"><button class="header-img1"><img src="/upload/header (3).png" width="30" alt=""></button></a>
                            <a href="/app/tables/basket/basket.php"><button class="header-img2"><img src="/upload/header (1).png" width="30" alt=""></button></a>
                        <?php else : ?>
                            <a href="/app/tables/users/profile.php"><button class="header-img1"><img src="/upload/profile.png" width="25" alt=""></button></a>
                            <a href="/app/tables/basket/basket.php"><button class="header-img2"><img src="/upload/basket.png" width="30" alt=""></button></a>
                        <?php endif ?>
                    </div>
                </div>


            </div>
        </nav>