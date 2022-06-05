<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Login form</title>
<?php include("top.php"); ?>
<h1>Prijavi se</h1>

<?php if (!empty($errorMessage)): ?>
    <p class="important"><?= $errorMessage ?></p>
<?php endif; ?>


<form action="<?= BASE_URL . "user/login" ?>" method="post">
    <p>
        <label>Uporabniško ime: <input type="text" name="username" autocomplete="off" 
            required autofocus /></label><br/>
        <label>Geslo: <input type="password" name="password" required /></label>
    </p>
    <p><button>Vpis</button></p>
</form>