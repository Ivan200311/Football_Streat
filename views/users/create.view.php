<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/header.php';
session_start(); ?>
<div class="cont">
    <form action="/app/tables/users/insert.php" method="post" class="form">
    <div class="form-group">
            <input type="text" name="surname" class="form-control" placeholder="1" id="surname" value="<?= $_SESSION['save']['surname'] ?? ''?>">
            <label for="surname" class="form-label">Фамилия*</label>
            <p class="error"><?= $_SESSION['error']['surname'] ?? '' ?></p>
        </div>
    
    
    <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="1" id="name" value="<?= $_SESSION['save']['name'] ?? ''?>">
            <label for="name" class="form-label">Имя*</label>
            <p class="error"><?= $_SESSION['error']['name'] ?? '' ?></p>
        </div>

        <div class="form-group">
            <input type="text" name="middle_name" class="form-control" placeholder="1" id="middle_name" value="<?= $_SESSION['save']['middle_name'] ?? ''?>">
            <label for="middle_name" class="form-label">Отчество*</label>
            <p class="error"><?= $_SESSION['error']['middle_name'] ?? '' ?></p>
        </div>

        <div class="form-group">
            <input type="text" name="phone" class="form-control" placeholder="1" id="phone" value="<?= $_SESSION['save']['phone'] ?? ''?>">
            <label for="phone" class="form-label">Ваш телефон*</label>
            <p class="error"><?= $_SESSION['error']['phone'] ?? '' ?></p>
        </div>
       
        <div class="form-group" style="display: none;">
            <select name="role" id="role">
                <?php foreach ($roles as $role) : ?>
                    <option value="<?= $role->id ?>"><?= $role->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="1" id="password">
            <label for="password" class="form-label">Пароль*</label>
            <p class="error"><?= $_SESSION['error']['password'] ?? '' ?></p>
        </div>
        <div class="form-group">
            <input type="password" name="password_confirmation" class="form-control" placeholder="1" id="password_confirmation">
            <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
            <p class="error"><?= $_SESSION['error']['repeat_password'] ?? '' ?></p>
        </div>
        <div class="form-group">
            <input type="checkbox" checked name="agreement" id="agreement">
            <label style="margin-left: 20px;" for="agreement" class="form-label">А ты согласен?</label>
            <p class="error"><?= $_SESSION['error']['exists'] ?? '' ?></p>
        </div>
        <div class="form-group">
            <button class="btnRegistr" name="btn">Зарегистрироваться</button>
        </div>
    </form>
</div>
<br><br>
<script>
    document.querySelector('#agreement').addEventListener('change', (e) => {
        document.querySelector('[name=btn]').disabled = !e.target.checked
    })
</script>

<?php 
unset($_SESSION['error']);
unset($_SESSION['save']);
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/templates/footer.php'; ?>