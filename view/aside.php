<?php
require_once("model/PredmetDB.php");
$predmeti = [];
$adm=false;
if(isset($_SESSION['UID'])){
    $predmeti =  PredmetDB::getAllFromUID($_SESSION['UID']);
}
if(isset($_SESSION['username']) and $_SESSION['username']=="admin"){
    $adm=true;
    $predmeti=PredmetDB::getAll();
}?>
<aside>
    <h3>Moji predmeti:</h3>
    <?php if(!$adm):?>
    <form action="<?= BASE_URL . "predmet/add" ?>">
        <input type="submit" value="Obiskuj nov predmet" />
    </form>
    <?php endif ?>
    <ul id="predmeti" style="list-style-type:none; list-style-position: inside; padding-left: 0;">
        <?php foreach ($predmeti as $p): ?>
            <li><a href="<?= BASE_URL . "predmet?PID=" . $p["PID"] ?>">
            <?= $p["naziv"] ?> (<?=($p["kratica"])?>)</a></li>
            <?php if(!$adm):?>
            <form action="<?= BASE_URL . "neObiskuje" ?>" method="post">
            <input type="hidden" name="PID" value=<?=$p["PID"]?>>
            <input type="submit" value="Prenehaj obiskovati" />
            <?php endif ?>
            <br>
            <br>
    </form>
        <?php endforeach; ?>
    </ul>
    
    
</aside>