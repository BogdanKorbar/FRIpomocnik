<?php
require_once("model/PredmetDB.php");
require_once("model/DogodekDB.php");

$predmeti = [];
$dogodki = [];
if(isset($_SESSION['UID'])){
    //echo("<script>console.log('PHPPPP: " . gettype(PredmetDB::getAll()) . gettype(PredmetDB::getAllFromUID($_SESSION['UID'])) . "');</script>");
    $dogodki=DogodekDB::getDogodke($_SESSION['UID']);
    $predmeti=PredmetDB::getAllFromUID($_SESSION['UID']);
    //echo("<script>console.log('PHPPPP: " . json_encode($results) ."              ". json_encode(($vsi[0])) . "');</script>");
    //$predmeti = array_diff($vsi,$vsiUID[0]);
    //echo("<script>console.log('PHPPPP: " . json_encode($ocene) ."              " . "');</script>");
    //echo("<script>console.log('PHPPPP: " . json_encode($ocene) ."              " . "');</script>");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>"/>
	    <title>Dogodki</title>
    </head>
    <body>
        <?php include("top.php"); ?>

        <?php foreach ($dogodki as $d): ?>
            <?php //echo("<script>console.log('PHPPPP: " . json_encode($o) ."              " . "');</script>");
                $pr=PredmetDB::get($d["PID"]); ?>
            <?= "Opis: ".$d["opis"].", datum: \"".$d["datum"]."\", Predmet: ". $pr["kratica"]." (".$pr["naziv"].")"?>
        <form action="<?= BASE_URL . "dogodki/delete" ?> " method="post">
            <input type="hidden" name="DID" value="<?= $d["DID"] ?>"  />
            <button>Izbris dogodka</button>
        </form>
            <br><br>
        <?php endforeach; ?>

<br>

<h4>Nov dogodek:</h4>
<form action="<?= BASE_URL . "dogodki/add" ?> " method="post">
    <label for="opis">Opis:</label>
        <input type="text" id="opis" name="opis"><br>
    <label for="datum">Datum:</label>
        <input type="date" id="datum" name="datum"><br>

    <label for="predmet">Izberi predmet:</label>
        <select name="predmet">
            <?php foreach ($predmeti as $p): ?>
                <option value="<?=$p["PID"]?>"><?= $p["naziv"]?></option>
            <?php endforeach; ?>
        </select>

        <button>Dodaj dogodek</button>
</form>

        <?php include("bottom.php"); ?>
    </body>
</html>