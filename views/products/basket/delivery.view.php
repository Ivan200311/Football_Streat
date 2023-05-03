<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php'; ?>
<h1 class="h1-delivery">Доставка и оплата</h1>
<main class="main-pay">
  <div class="devAndPay">
    <div class="blok1">
      <details open class="details-pay">
        <summary>Информация по оплате</summary>
        <div class="tab-content">
          <p class="p-delivery">Оплата производится наличными или картой в магазине по нашим адресам.</p>
        </div>
      </details>
      <details open class="details-pay">
        <summary>Информация по доставке</summary>
        <div class="tab-content">
          <p class="p-delivery">Самовывоз доступен с 10:00 до 21:00 ежедневно, без выходных.</p>
        </div>
      </details>
      <details open class="details-pay">
        <summary>Как оформить заказ ?</summary>
        <div class="tab-content">
          <p class="p-delivery">Для оформления заказа нужно выбрать товары на сайте, положить их в корзину и заполнить форму заказа.
            <br>Вы также можете оформить заказ, позвонив по телефону +7 (800) 500-40-20.
          </p>
        </div>
      </details>
    </div>
    <div>
      <div class="blok2">
        <details class="details-pay-adress">
          <summary>Наши адреса</summary>
          <div class="tab-content">
            <?php foreach ($deliveries as $delivery) : ?>
              <p class="p-delivery"><?= $delivery->address ?> <br> Телефон: <?= $delivery->phone ?> </p>
              </select>
            <?php endforeach ?>
          </div>
        </details>
      </div>
      <div class="blok3">
        <div class="tab-content">
          <p><iframe class="frame-img" src="https://yandex.ru/map-widget/v1/?um=constructor%3Ac4fdf5643e2da65f7bc55acfe79d0e7d26726a50d5e452c9913cde7f370f4365&amp;source=constructor" width="700" height="500" frameborder="0"></iframe></p>
        </div>
      </div>
    </div>
</main>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php'; ?>