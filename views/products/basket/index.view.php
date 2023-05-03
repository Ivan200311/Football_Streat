<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php'; ?>
<div>
    <img class="head-img" src="/upload/rodrigo_banner2_v4.png" alt="">
</div>
<div class="new">
    <div class="stroka-new">
        <p class="new-product" href="">Новинки</p>
    </div>
    <div class="new-products">
        <?php foreach($products as $product):?>
            <div>
            <a href="/app/tables/products/show.php?id=<?=$product->id?>"><img src="/upload/<?=$product->photo?>"  class="card-img-new" alt="image"></a>
            </div>
        <?php endforeach?>
    </div>
</div>


<div class="info-store-index">
    <div class="img-index-center">
    <p><img class="img-index" src="/upload/21.png" alt=""></p>
    </div>
    <div class="info-store-index-text">
    <h1 class="info-store-index">О нас</h1>
            <p class="p-index-store">Мы любим футбол и разбираемся в нем. Нам интересно все, что с ним связано.  <br><br>Мы играем сами и поэтому знаем, что нужно для того, чтобы игра приносила максимальное удовольствие.  <br>FootballStreat - это не просто специализированный спортивный магазин. Это – настоящий Дом Футбола.  <br>  <br> Место, где каждый увлеченный футболом сможет не только подобрать лучшую экипировку, но и найти единомышленников, почувствовать себя членом единой команды.</p>
            <br><div class="brend-index2"> 
            <p href=""><img class="img-brends2" src="/upload/pngwing.com (21).png" alt=""></p>
            <p href=""><img class="img-brends2" src="/upload/pngwing.com (20).png" alt=""></p>
            <p href=""><img class="img-brends2" src="/upload/pngwing.com (13).png" alt=""></p>
            <p href=""><img class="img-brends-mizuno" src="/upload/pngwing.com (14).png" alt=""></p>
            </div>
        </div>
</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php'; ?>