<?php
require_once("model/PredmetDB.php");

$predmeti = [];
if(isset($_SESSION['username']) and $_SESSION['username']=="admin"){
    //echo("<script>console.log('PHPPPP: " . gettype(PredmetDB::getAll()) . gettype(PredmetDB::getAllFromUID($_SESSION['UID'])) . "');</script>");
    $predmeti=PredmetDB::getAll();
    //echo("<script>console.log('PHPPPP: " . json_encode($results) ."              ". json_encode(($vsi[0])) . "');</script>");
    //$predmeti = array_diff($vsi,$vsiUID[0]);
    //$ocene=OcenaDB::getOcene($_SESSION['UID']);
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
	    <title>FRIpomočnik</title>
    </head>
    <body>
        <?php include("top.php"); ?>
        <?php include("aside.php"); ?>
        <section>
            <p>Pozdravljeni na stran FRI pomočnika.</p>
        </section>
        <?php include("bottom.php"); ?>
    </body>
</html>





<!--<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="style.css">
<meta charset="UTF-8" />
<title>FRIpomočnik</title>

<h1>Vsi predmeti</h1>

<ul>
    

</ul>>-->
