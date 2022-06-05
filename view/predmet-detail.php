<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Predmet detail</title>
<?php 
include("top.php"); 
include("aside.php");
?>
<section>

    <ul style="list-style-type:none">
        <li>Kratica: <b><?= $predmet["kratica"] ?></b></li>
        <li>Naziv: <b><?= $predmet["naziv"] ?></b></li>
        <li>Opis: <b><?= $predmet["opis"] ?></b></li>
    </ul>
    <?php
    if(isset($_SESSION['username']) and $_SESSION['username']=="admin"):?>
    <p> <a href="<?= BASE_URL . "predmet/edit?PID=" . $_GET["PID"] ?>">Uredi</a>
    <form action="<?= BASE_URL . "predmet/delete" ?>" method="post">
        <input type="hidden" name="PID" value="<?= $predmet["PID"] ?>"  />
        <button class="important" onclick="return confirm('Are you sure you want to delete this item?');">Izbris predmeta</button>
    </form>
    <?php endif; ?>
</section>
<?php include("bottom.php"); ?>
