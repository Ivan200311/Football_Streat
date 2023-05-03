<?php 
session_start();
if (!isset($_SESSION["admin"]) || !$_SESSION["admin"]) {
    header("Location: /app/admin/auth.php");
    die();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.admin.php'; ?>
<div class="conteiner">
    <div class="cont cont_panel">
        <div class="nav-order">
            <div class="chec-flex">
                <form action="" class="chec">

                    <?php foreach ($statuses as $status) : ?>
                        <div class="input">
                            <input type="checkbox" <?= isset($_GET['status']) && $_GET['status'] == $status->id ? 'checked' : '' ?> onchange="this.form.submit()" name="status" value="<?= $status->id ?>"></input>
                            <p for=""><?= $status->name ?></p>
                        </div><?php endforeach ?>

                </form>
            </div>
        </div>
    </div>
</div>


<div class="conteiner_orders">
    <table>
        <tr>
            <th>id</th>
            <th>Пользователь</th>
            <th>Номер телефона</th>
            <th>Статус</th>
            <th>Причина отказа</th>
            <th>Самовывоз</th>
            <th>Дата создания</th>
            <th>Дата обновления</th>
            <th>Количество товаров</th>
            <th>Сумма заказа</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($orders as $order) : ?>
            <tr class="block">
                <td><?= $order->id ?></td>
                <td><?= $order->person_name ?></td>
                <td><?= $order->phone ?></td>
                <td><select class="select" data-order-id="<?= $order->id ?>" name="" id="select<?= $order->id ?>">
                        <?php foreach ($statuses as $status) : ?>
                            <option class="state" value="<?= $status->id ?>" <?= $status->id == $order->status_id ? "selected" : "" ?>><?= $status->name ?></option>
                        <?php endforeach ?>
                    </select></td>
                <td>
                    <form action="/app/admin/change.php" method="POST">
                        <textarea disabled name="reason_cancel" data-textarea="<?= $order->id ?>" id="order_id" class="reason_cancel" cols="30" rows="10"><?= $order->reason_cancel ?></textarea>
                        <button value="<?= $order->id ?>" name="saveAS" class="save" data-order-id="<?= $order->id ?>">Сохранить</button>
                </td>
                </form>
                <td><?= $order->delivery ?></td>
                <td><?= $order->date_order ?></td>
                <td><?= $order->updated_at ?></td>
                <td><?= $order->count ?></td>
                <td><?= $order->sum ?>₽</td>
                <td class="doing">

                    <a href="/app/admin/productsByOrder.php?id=<?= $order->id ?>" class="pros">Просмотреть</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<script src="/accers/js/fetch.js"></script>
<script src="/accers/js/LoadOrders.js"></script>
<!-- <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php'; ?> -->