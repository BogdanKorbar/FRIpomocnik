<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Registracija</title>
<?php include("view/top.php"); ?>
<form action="<?= BASE_URL . "user/register" ?>" method="post">
<p><label>Uporabniško ime: <input type="text" name="username" value="<?= $user["username"] ?>" autofocus />
        <span class="important"><?= $errors["username"] ?></span>
    </label>
    <p><label>Geslo: <input type="password" name="password" value="<?= $user["password"] ?>" />
        <span class="important"><?= $errors["password"] ?></span>
    </label>
    </p>
    <p><button>Registriraj</button></p>
</form>
<?php include("view/bottom.php"); ?>

