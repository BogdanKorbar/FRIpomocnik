<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Predmet edit</title>
<?php include("view/top.php"); ?>

<form action="<?= BASE_URL . "predmet/edit" ?>" method="post">
    <input type="hidden" name="PID" value="<?= $predmet["PID"] ?>"  />
    <p><label>Kratica: <input type="text" name="kratica" value="<?= $predmet["kratica"] ?>" autofocus />
        <span class="important"><?= $errors["kratica"] ?></span>
    </label>
    <p><label>Naziv: <input type="text" name="naziv" value="<?= $predmet["naziv"] ?>" />
        <span class="important"><?= $errors["naziv"] ?></span>
    </label>
    </p>
    <p><label>Opis: <input type="text" name="opis" value="<?= $predmet["opis"] ?>" />
        <span class="important"><?= $errors["opis"] ?></span>
    </label>
    </p>
    <p><button>Uredi</button></p>
</form>
<?php include("view/bottom.php"); ?>
