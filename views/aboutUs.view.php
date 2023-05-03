<?php

use App\models\Information;

require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php'; ?>
<div class="text-aboutUs">
        <?php foreach ($informations as $item) : $content = Information::informat_content($item->id); ?>
            <div class="card center">
                <div class="front"><p class="title-about"><?= $content->title ?></p>
                    <img src="/upload/<?= $content->image ?>" alt="">
                </div>
                <div class="back">
                    <div class="back-content center">
                    <p class="content-about"><?= $content->content ?></p>
                        <i class="fas fa-heart"></i>
                    </div>
                </div>

            </div>
        <?php endforeach ?>
    </div>

<div class="info-aboutUs">
    <div>
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="/upload/adidas-store-i-new-york-02-coolsneakers.jpg" class="d-block w-100 " alt="...">
    </div>
    <div class="carousel-item">
      <img src="/upload/fussball_schuhe_muenchen.jpg" class="d-block w-100  " alt="...">
    </div>
    <div class="carousel-item">
      <img src="/upload/926688d3c7fd50fc4d69893506e9fe92.jpg" class="d-block w-100 " alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden"><</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">></span>
  </button>
</div>
    </div>
    <div class="address-aboutUs-map">
        <h1 class="h1-about">Наши магазины на карте:</h1>
        <br>
    <p><iframe class="frame-img" src="https://yandex.ru/map-widget/v1/?um=constructor%3Ac4fdf5643e2da65f7bc55acfe79d0e7d26726a50d5e452c9913cde7f370f4365&amp;source=constructor" width="700" height="500" frameborder="0"></iframe></p>
    </div>
</div>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php'; ?>