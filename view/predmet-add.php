<?php
require_once("model/PredmetDB.php");
$predmeti = [];
if(isset($_SESSION['UID'])){
    //echo("<script>console.log('PHPPPP: " . gettype(PredmetDB::getAll()) . gettype(PredmetDB::getAllFromUID($_SESSION['UID'])) . "');</script>");
    $vsi=PredmetDB::getAll();
    $vsiUID=PredmetDB::getAllFromUID($_SESSION['UID']);
    $results = array_diff(array_map('serialize',$vsi),array_map('serialize',$vsiUID));
    $predmeti = array_map('unserialize',$results);
    //echo("<script>console.log('PHPPPP: " . json_encode($results) ."              ". json_encode(($vsi[0])) . "');</script>");
    //$predmeti = array_diff($vsi,$vsiUID[0]);
}?>
<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Dodaj predmet</title>
<?php include("view/top.php"); ?>
<form action="<?= BASE_URL . "obiskuje" ?> " method="post">
    <label for="IzberiPredmet">Izberi predmet:</label>
        <select name="IzberiPredmet">
            <?php foreach ($predmeti as $p): ?>
                <option value="<?=$p["PID"]?>"><?= $p["kratica"]?></option>
            <?php endforeach; ?>
        </select>
        <button>Izberi</button>
</form><br>
Ali dodaj novega:


<form action="<?= BASE_URL . "predmet/add" ?>" method="post">
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
    <p><button>Dodaj</button></p>
</form>
<?php include("view/bottom.php"); ?>