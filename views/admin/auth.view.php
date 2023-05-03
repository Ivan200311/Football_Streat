<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.admin.php'; ?>
<br>
<form class="createF" action="/app/admin/autnCheck.php" method="POST">
    <label for="phone">
        Введите логин
        <input type="phone" class="form-control" name="phone">
    </label>
    <label for="password" class="form-label">Введите пароль
        <input type="password" name="password" class="form-control" id="password">
    </label>

    <?php if (!empty($_SESSION["error"])) : ?>
        <p class="error"><?= $_SESSION["error"] ?></p>
    <?php endif ?>
    <br><br>
    <div class="form-group">
        <button name="admin">Войти</button>
    </div>
</form>
<?php unset($_SESSION["error"]); ?>
</body>

</html>