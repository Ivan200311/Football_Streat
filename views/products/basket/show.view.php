<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php'; ?>
<main class="main-show">
    <div class="info-product">
        <div>
            <div class="img-div-tovar">
                <p><img class="img-id-product" src="/upload/<?= $product->photo ?>" alt=""></p>
            </div>
            <div class="btn-korzina"><button id='btn-<?= $product->id ?>' data-btn-id=<?= $product->id ?> class='btn-basket btn btn-primary'>Добавить в корзину</button></div>
        </div>
        <div class="name-id-product">
            <p class="name-product"><?= $product->name ?></p>
            <br><br>
            <h1 class="h1-show"><?= $product->price ?>₽</h1>
            <br>
            <form action="/app/" method="POST">
                <p class="h1-show"><select class="sizes" id="size_selecter" aria-label="Default select example">
                        <option value="0" selected disabled>Размер</option>
                        <?php foreach ($sizes as $size) : ?>
                            <option value="<?= $size->ptr ?>"><?= $size->size ?></option>
                        <?php endforeach ?>
                    </select><br><a class="size-table" href="/app/tables/products/tableSize.php">Таблица размеров</a></p>
                     <p class="error"></p>
                <br>
                <h1 class="h1-show">Описание:</h1>
                <p class="p-info"><?= $product->description ?></p>
                <h1 class="h1-show">Релиз:</h1>
                <p class="p-info"><?= $product->year_release ?></p>
                <br>




            </form>


        </div>
    </div>


    <br>
    <div class="info-pr">
        <h1 class="info-h1">Информация о товаре:</h1>
        <br>
        <p>Категория: ............ <?= $product->category ?></p>
        <p>Бренд: ................... <?= $product->brand ?></p>
        <p>Страна: ................. <?= $product->country ?></p>
    </div>
</main>
<script src="/accers/js/fetch.js"></script>
<script src="/accers/js/show.js"></script>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php'; ?>