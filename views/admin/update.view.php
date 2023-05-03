<?php
session_start();
if (!isset($_SESSION["admin"]) || !$_SESSION["admin"]) {
    header("Location: /app/admin/auth.php");
    die();
}
use App\models\Quantity;

require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.admin.php'; ?>

<form action="/app/admin/update.php" class="updateProduct" method="POST" enctype="multipart/form-data">

    <input type="hidden" class="form-control" name="id" value="<?= $product->id ?>">
    <div class="div-update-input">
        <label class="label-form" for="name">Введите название: </label>
        <input type="text" class="form-control" name="name" value="<?= $product->name ?>">
    </div>
    <div class="div-update-input">
        <label class="label-form" for="price">Введите цену: </label>
        <input type="number" class="form-control" name="price" value="<?= $product->price ?>">
    </div>
    <div class="div-update-input">
        <label class="label-form" for="description">Введите описание: </label>
        <input type="text" class="form-control" name="description" value="<?= $product->description ?>">
    </div>
    <div class="div-update-input">
        <label class="label-form" for="release">Введите год релиза: </label>
        <input type="number" class="form-control" name="year_release" value="<?= $product->year_release ?>">
    </div>
    <div class="div-update-input">
        <label class="label-form" for="image">Выберите картинку: </label>
        <input type="file" class="form-control" name="photo" id="file">

        <img src="/upload/<?= $product->photo != null ? $product->photo : '' ?>" alt="" id="loadedImg" width="80" height="80">
    </div>
    <div class="div-update-input">
        <label class="label-form" for="country">Выберите страну: </label><select name="country_id" class="form-control" id="">
            <?php foreach ($countries as $country) : ?>
                <option value="<?= $country->id ?>" <?= $country->id == $product->country_id ? 'selected' : ' ' ?>><?= $country->name ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="div-update-input">
        <label class="label-form" for="category">Выберите категорию: </label><select name="category_id" class="form-control" id="">
            <?php foreach ($categories as $category) : ?>
                <option value="<?= $category->id ?>" <?= $category->id == $product->category_id ? 'selected' : ' ' ?>> <?= $category->name ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="div-update-input">
        <label class="label-form" for="category">Выберите бренд: </label><select name="brand_id" class="form-control" id="">
            <?php foreach ($brands as $brand) : ?>
                <option value="<?= $brand->id ?>" <?= $brand->id == $product->brand_id ? 'selected' : ' ' ?>> <?= $brand->name ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="div-update-input">
        <label class="label-form" for="category">Выберите размер: </label><select name="size_id" class="form-control" id="size_id">
            <?php foreach ($sizes_product as $size) : ?>
                <option id="<?= $size->ptr?>" value="<?= $size->ptr ?>"> <?= $size->size ?> </option>
            <?php endforeach ?>
        </select>
        <?php foreach ($sizes_product as $size) : ?>


      
        <?php endforeach ?>
        <?php 
        $str=Quantity::quantity( $sizes_product[0]->ptr);        ?>
                <input type="number" class="form-control" name="quantity" value="<?= $str->quantity?>">
    </div>

    </div>
    <button class="button-save-up" name="save" for="image" value="<?= $product->id ?>">Сохранить</button>
</form>
<script src="/accers/js/updateQuantity.js"></script>
<script src="/accers/js/fetch.js"></script>