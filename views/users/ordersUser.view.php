<?php
if (!isset($_SESSION['auth']) || !$_SESSION['auth']) {
    header('Location: /');
    die();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php'; ?>
<div>
    <?php foreach ($orders as $order) : ?>
        <h1 class="h1_numberOrders">Заказ № <?= $order->id ?></h1> 
        <div class="info-orders">
        <p>Дата заказа: <br><?= $order->date_order ?></p>
        <p>Статус заказа: <br><?= $order->status ?></p>
        <p>Адрес самовывоза: <br><?= $order->address ?></p>
        <p>Cумма заказа: <?= $order->sum ?>₽</p>
    </div><br>
        <div class="block_ordersPerson">
            
            <?php foreach ($user as $user_orders) :?>
                <?php if ($order->id == $user_orders->order_id) : ?>
                    <p class="name_tovarOrder">Товар: <br><?= $user_orders->name ?></p>
                    <p><img class="image_orders" src="/upload/<?= $user_orders->photo ?>" alt=""></p>
                    <p>Количество: <br><?= $user_orders->quantity?></p>
                    <p>Размер: <br><?= $user_orders->size?></p>
                    <p>Цена за шт: <br><?= $user_orders->price_product_order?>₽</p>
                    <br>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    <?php endforeach ?>
</div>


<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php'; ?>