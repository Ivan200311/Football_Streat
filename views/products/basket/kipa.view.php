<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php'; ?>

</div>
<div class="sort-kipa">
    <form action="/app/tables/products/filterKipa.php" method="POST">
        <div id="sortform">
            <select class="form-select-sort" name="sort" id="sort" onchange="this.form.submit()">
                <option value="">Сортировка</option>
                <option <?= isset($_SESSION["save"]["sort"]) ? ($_SESSION["save"]["sort"] == "ORDER BY products.price" ? "selected" : "") : "" ?> value="ORDER BY products.price">По цене (&#8593;)</option>
                <option <?= isset($_SESSION["save"]["sort"]) ? ($_SESSION["save"]["sort"] == "ORDER BY products.price DESC" ? "selected" : "") : "" ?> value="ORDER BY products.price DESC">По цене(&#8595;) </option>
                <option <?= isset($_SESSION["save"]["sort"]) ? ($_SESSION["save"]["sort"] == "ORDER BY products.name" ? "selected" : "") : "" ?> value="ORDER BY products.name">По наименованию (&#8593;) </option>
                <option <?= isset($_SESSION["save"]["sort"]) ? ($_SESSION["save"]["sort"] == "ORDER BY products.name DESC" ? "selected" : "") : "" ?> value="ORDER BY products.name DESC">По наименованию (&#8595;)</option>
                <option <?= isset($_SESSION["save"]["sort"]) ? ($_SESSION["save"]["sort"] == "ORDER BY countries.name DESC" ? "selected" : "") : "" ?> value="ORDER BY countries.name DESC">По стране (&#8593;) </option>
                <option <?= isset($_SESSION["save"]["sort"]) ? ($_SESSION["save"]["sort"] == "ORDER BY countries.name" ? "selected" : "") : "" ?> value="ORDER BY countries.name">По стране (&#8595;) </option>
            </select>
        </div>
        <div class="form-select-boots-div">
        <select name="size" class="form-select-boots" onchange="this.form.submit()">
            <option value="all" selected disabled>Размер</option>
            <?php foreach ($sizes as $size) : ?>
                <option <?= isset($_SESSION["save"]["size"]) ? ($_SESSION["save"]["size"] == $size->id ? "selected" : "") : "" ?> value="<?= $size->id ?>"><?= $size->size ?></option>
            <?php endforeach ?>
        </select>

        <select name="brand" class="form-select-boots" onchange="this.form.submit()">
            <option value="all" selected disabled>Бренд</option>
            <?php foreach ($brands as $brand) : ?>
                <option <?= isset($_SESSION["save"]["brand"]) ? ($_SESSION["save"]["brand"] == $brand->id ? "selected" : "") : "" ?> value="<?= $brand->id ?>"><?= $brand->name ?></option>
            <?php endforeach ?>
        </select>

        <select name="country" class="form-select-boots" onchange="this.form.submit()">
            <option value="all" selected disabled>Страна</option>
            <?php foreach ($countries as $country) : ?>
                <option <?= isset($_SESSION["save"]["country"]) ? ($_SESSION["save"]["country"] == $country->id ? "selected" : "") : "" ?> value="<?= $country->id ?>"><?= $country->country ?></option>
            <?php endforeach ?>
        </select>
    </div>
    </form>
</div>
<div class="boots-products">

    <div class="card-boots">
        <?php foreach ($products as $product) : ?>
            <div class="card-boot">
                <p><img class="img-card" src="/upload/<?= $product->photo ?>" alt="<?= $product->name ?>"></p>
                <div class="stroka-boots">
                    <h1 class="name-boots"><?= $product->name ?></h1>
                    <p><?= $product->price ?>₽</p>
                    <button class="info-boots"><a class="a-info-boots" href="/app/tables/products/show.php?id=<?= $product->id ?>">Подробнее</a></button>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<script>
    document.querySelector("#sortKipa").addEventListener("change", function() {
        console.log(111)
        document.querySelector("#sortformKipa").submit()
    })
</script>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php'; ?>