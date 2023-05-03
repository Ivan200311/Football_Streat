<?php
if (!isset($_SESSION['auth']) || !$_SESSION['auth']) {
    header('Location: /');
    die();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php'; ?>
<div class="profile">
    <div class="prof-div">
        <div>
            <div class="address-aboutUs-profile">
                <details>
                    <summary>Как вернуть товар?</summary>
                    <div class="tab-content-profile">
                        <p class="p-prof">Обмен и возврат товара надлежащего качества производится в течение 14 дней с момента его получения. При этом должны быть сохранены: товарный вид, потребительские свойства, комплектация, фабричные ярлыки и чеки. Возврат происходит в пунктах наших магазинов по адресам ниже: </p>
                        <?php foreach ($deliveries as $delivery) : ?>
                            <p class="p-delivery"><?= $delivery->address ?> <br> Телефон: <?= $delivery->phone ?> </p>
                            </select>
                        <?php endforeach ?>
                    </div>
                </details>
            </div>
            <div class="address-aboutUs-profile">
                <details>
                    <summary>Нужна помощь?</summary>
                    <div class="tab-content-profile">
                        <p class="p-prof">У вас есть вопросы? Напишите нам на почту info@football-streat.ru. </p>
                    </div>
                </details>
            </div>
            <div class="address-aboutUs-profile">
                <details>
                    <summary>Часто задаваемые вопросы</summary>
                    <div class="tab-content-profile">
                        <h1 class="h1-pr">Какой размер обуви указан на сайте? Российский или европейский?</h1>
                        <p class="p-prof">На сайте footballstreat.ru указан российский размер, а на самой обуви указан европейский размер. У каждого товара на сайте имеется полная размерная сетка, которая позволяет сопоставить все параметры и определиться с выбором. Например, у бренда Nike: размер РФ 41 (на сайте) = 42 EUR (по факту на обуви).</p>
                        <br>
                        <h1 class="h1-pr">У вас оригинальный товар?</h1>
                        <p class="p-prof">Мы отвечаем за качество наших товаров и являемся официальным партнером всех брендов, которые представлены на сайте footballstreat.ru. Вся обувь, экипировка и другие товары полностью оригинальные.</p>
                        <br>
                        <h1 class="h1-pr">Есть ли доставка по РФ и в страны СНГ?</h1>
                        <p class="p-prof">Магазин footballstreat.ru работает только по самовывозу.</p>
                    </div>
                </details>
            </div><br>
            <div class="btn-profile">
                <a href="/app/tables/users/logout.php"><button class="btn-vx-profile">Выйти из профиля</button></a>
            </div>
        </div>
        <div class="profile__block profile__block_one">
            <h1 class="h1-profile">Профиль</h1>
            <br>
            <p>Фамилия: <?= $user->surname ?></p>
            <p>Имя: <?= $user->name ?></p>
            <p>Отчество: <?= $user->middle_name ?></p>
            <p>Телефон: <?= $user->phone ?></p>
            <a href="/app/tables/users/ordersUser.php">
                <p>Мои заказы</p>
            </a>
        </div>
    </div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php'; ?>