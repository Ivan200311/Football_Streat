<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php';
session_start(); ?>

<div class="conteiner-basket">
    <h3 class="title_basket">Корзина</h3>

    <?php $_SESSION['basket'] = $productsInBasket;
    if (empty($_SESSION['basket'])) : ?>
        <p><?php $_SESSION['empty'] = 'Пока ничего нет';
            $sum = 0;
            $count = 0; ?></p>
    <?php endif; ?>


    <div class="block" data-clear="all">
        <h4 class="empty"><?= $_SESSION['empty'] ?? '' ?></h4>
        <?php foreach ($productsInBasket as $item) : ?>
            <div class="block_basket-foot" data-block="<?= $item->product_id ?>">
                <div class="block_img_name-foot">
                    <img class="image_basket" src="/upload/<?= $item->photo ?>" alt="image">
                    <div class="block_flex">
                        <p><?= $item->name ?></p>
                        <p class="priceOne">Цена за штуку: <?= $item->price ?>₽</p>
                    </div>
                </div>
                <div class="block_btn-foot">
                    
                    <button id="button-foot" class="minus" data-size-products-id="<?= $item->size_products_id ?>" data-product-id="<?= $item->product_id ?>">-</button>
                    <p class="countProductInBasket" id="count-<?= $item->product_id ?>"><?= $item->quantity ?></p>
                    <button id="button-foot" data-size-products-id="<?= $item->size_products_id ?>" class="plus" data-product-id="<?= $item->product_id ?>">+</button>
                    <p>Размер: <?= $item->size ?></p>
                    <p class="resultOnePosition" data-price-position="<?= $item->product_id ?>"><?= $item->price_position ?>₽</p>
                    <button id="button-foot" data-size-products-id="<?= $item->size_products_id ?>" data-product-id="<?= $item->product_id ?>" class="delete">Удалить</button>
             
            </div>
            </div>
        <?php endforeach ?>
    </div><br>
    <form action="/app\tables\basket\order.php" method="POST">
        <div class="blockResult">
            <div class="pynkt">
                <?php if (isset($_SESSION["error"])):?>
                    <p class="errorsssss"><?= $_SESSION["error"];?></p>
                    <?php endif?>
                <select name="delivery_id" class="delivery" aria-label="Default select example">
                    <option value="0" selected disabled>Пункт самовывоза</option>
                    <?php foreach ($deliveries as $delivery) : ?>
                        <option <?= isset($_GET['delivery']) && $_GET['delivery'] == $delivery->id ? 'selected' : '' ?> name="" value="<?= $delivery->id ?>"><?= $delivery->address ?></option>
                    <?php endforeach ?>
                </select>

            </div><br>
            <p class="sum">Итого: <?= $sum ?>₽</p>
            <p class="count">Количество: <?= $count ?>шт</p>
        </div>
        <div class="block_btn">
            
            <button id="button-foot" type="submit" name="make_order" class="order-btn">Оформить заказ</button>

        </div>
    </form><br>
    <div class="block_btn">
    <button id="button-foot" class="clear" data-clear="all">Очистить корзину</button>
    </div>
</div>


</div>
<script src="/accers/js/fetch.js"></script>
<script src="/accers/js/loadBasket.js"></script>
<?php
unset($_SESSION['empty']);
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php'; ?>