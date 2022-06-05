<?php
require_once("model/PredmetDB.php");
require_once("model/OcenaDB.php");

$predmeti = [];
$ocene = [];
if(isset($_SESSION['UID'])){
    //echo("<script>console.log('PHPPPP: " . gettype(PredmetDB::getAll()) . gettype(PredmetDB::getAllFromUID($_SESSION['UID'])) . "');</script>");
    $predmeti=PredmetDB::getAllFromUID($_SESSION['UID']);
    //echo("<script>console.log('PHPPPP: " . json_encode($results) ."              ". json_encode(($vsi[0])) . "');</script>");
    //$predmeti = array_diff($vsi,$vsiUID[0]);
    $ocene=OcenaDB::getOcene($_SESSION['UID']);
    echo("<script>console.log('PHPPPP: " . json_encode($ocene) ."              " . "');</script>");
    //echo("<script>console.log('PHPPPP: " . json_encode($ocene) ."              " . "');</script>");
}
?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Ocene</title>

<?php
    //echo("<script>console.log('PHPPPP: " . json_encode($ocene) ."              " . "');</script>");

include("view/top.php"); ?>

<?php foreach ($ocene as $o): ?>
    <?php //echo("<script>console.log('PHPPPP: " . json_encode($o) ."              " . "');</script>");
        $pr=PredmetDB::get($o["PID"]); ?>
    <?= "Ocena: ".$o["cifra"].", Opis: \"".$o["opis"]."\", Predmet: ". $pr["kratica"]." (".$pr["naziv"].")"?>
<form action="<?= BASE_URL . "ocene/delete" ?> " method="post">
    <input type="hidden" name="OID" value="<?= $o["OID"] ?>"  />
    <button>Izbris ocene</button>
    </form>
    <br><br>
<?php endforeach; ?>
    
<br>

<form action="<?= BASE_URL . "ocene/add" ?> " method="post">
    <label for="cifra">Ocena(5-10):</label>
        <input type="number" id="cifra" name="cifra" min="5" max="10"><br>
    <label for="opis">Opis:</label>
        <input type="text" id="opis" name="opis"><br>
    <label for="predmet">Izberi predmet:</label>
        <select name="predmet">
            <?php foreach ($predmeti as $p): ?>
                <option value="<?=$p["PID"]?>"><?= $p["naziv"]?></option>
            <?php endforeach; ?>
        </select>

        <button>Dodaj oceno</button>
</form>
<?php include("view/bottom.php"); ?>