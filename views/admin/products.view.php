<?php
session_start();
if (!isset($_SESSION["admin"]) || !$_SESSION["admin"]) {
    header("Location: /app/admin/auth.php");
    die();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.admin.php'; ?>
<div class="conteiner">
    <div class="cont cont_panel">
        <div class="block">
            <form action="/app/admin/search.php" method="POST" class="conteiner_pos category">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="all" id="all" checked value="all">
                    <label class="form-check-label" for="all">
                        Все
                    </label>
                </div>
                <?php foreach ($categories as $category) : ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="category" value="<?= $category->id ?>" id="<?= $category->id ?>">
                        <label class="form-check-label" for="<?= $category->id ?>">
                            <?= $category->name ?>
                        </label>
                    </div><?php endforeach ?>
            </form>
        </div>
    </div>
</div>
</div>
</form>
<button class="insert">Добавить</button>
<div class="modal-wrapper">
    <form class="modal" action="/app/admin/create.php" method="POST">
        <div class="new">
            <div class="new_group">
                <label for="name">Название</label>
                <input class="inp" type="text" name="name">
            </div>
            <div class="new_group">
                <label for="price">Цена</label>
                <input class="inp" type="text" name="price">
            </div>
            <div class="new_group">
                <label for="description">Описание</label>
                <input class="inp" type="text" name="description">
            </div>
            <div class="new_group">
                <label for="release_year">Год создания</label>
                <input class="inp" type="number" name="year_release">
            </div>
            <div class="new_group">
                <label for="photo">Изображение</label>
                <input class="inp" type="file" name="photo">
            </div>
            <div class="new_group">
                <label for="country">Страна</label>
                <select class="inp" name="country_id" id="country">
                    <?php foreach ($countries as $country) : ?>
                        <option value="<?= $country->id ?>"><?= $country->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="new_group">
                <label for="brand">Бренд</label>
                <select class="inp" name="brand_id" id="brand">
                    <?php foreach ($brands as $brand) : ?>
                        <option value="<?= $brand->id ?>"><?= $brand->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="new_group">
                <label for="category">Категория</label>
                <select class="inp" name="category_id" id="category">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="new_group">
                <label for="table_size_id">Размер</label>
                <select class="inp" name="table_size_id" id="size">
                    <?php foreach ($sizes as $size) : ?>
                        <option value="<?= $size->id ?>"><?= $size->size ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="new_group">
                <label for="quantity">Количество</label>
                <input class="inp" type="number" name="quantity">
            </div><br>
            <div class="new_group btn_prod">
                <button class="create btn" name="create">Создать</button>
            </div>

            <br><br>
        </div>
    </form>
</div>
<table>
    <tr>
        <th>id</th>
        <th>Название</th>
        <th>Цена</th>
        <th>Год создания</th>
        <th>Изображение</th>
        <th>Страна</th>
        <th>Категория</th>
        <th>Бренд</th>
        <th>Действие</th>
    </tr>
    <tbody class="block cont_product">

    </tbody>
</table>
</div>


<script src="/accers/js/fetch.js"></script>
<script src="/accers/js/loadProducts.js"></script>
<script src="/accers/js/loadProductsTovar.js"></script>
<!-- <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php'; ?> -->