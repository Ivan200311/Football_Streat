<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php';
session_start(); ?>
<form class="auth" action="/app/tables/users/authCheck.php" method="POST">
    <div class="autoriz">
        <div class="form-group">
            <p class="p-auth">Вход</p>
        </div>
        <div class="form-group">
            <input type="text" name="phone" class="form-control" placeholder="1" id="phone" value="<?= $_SESSION['save'] ?? '' ?>">
            <label for="phone" class="form-label">Телефон*</label>
            <p class="error"><?= $_SESSION['error']['phone'] ?? '' ?></p>
        </div>

        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="1" id="password">
            <label for="password" class="form-label">Пароль*</label>
            <p class="error"><?= $_SESSION['error']['password'] ?? '' ?></p>
        </div>


        <div class="form-group">
            <?php if (!empty($_SESSION['error']['null'])) : ?>
                <p class="error"><?= $_SESSION['error']['null'] ?></p>
            <?php endif ?>
        </div>
        <div class="form-group-btn">
            <button class="btnVhod" name="btnVhod">Войти</button>
        </div>

</form>
</div>
<div class="form-group-btn">
    <a href="/app/tables/users/create.php"><button class="btnReg" name="btnReg">Зарегистрироваться</button></a>
</div>



<?php
unset($_SESSION['error']);
unset($_SESSION['save']);

require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php'; ?>