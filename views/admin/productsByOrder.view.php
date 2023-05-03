<?php 
session_start();
if (!isset($_SESSION["admin"]) || !$_SESSION["admin"]) {
    header("Location: /app/admin/auth.php");
    die();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.admin.php'; ?>

<table class="conteiner-orderss">

    <tr>
        <th>№</th>
        <th>Пользователь</th>
        <th>Изображение</th>
        <th>Название</th>
        <th>Размер</th>
        <th>Количество</th>
        <th>Цена</th>
    </tr>

    <tbody>
        <?php foreach ($productsInOrder as $product) : ?>
            <tr>
                <td><?= $product->order_id ?></td>
                <td><?=$product->pers_name?><br> <?=$product->mail?></td>
                <td><img src="/upload/<?= $product->image ?>" alt="image" width="50"></td>
                <td><?= $product->name ?></td>
                <td><?= $product->size ?></td>
                <td><?= $product->product_count ?></td>
                <td><?= $product->price_product_order ?>₽</td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

