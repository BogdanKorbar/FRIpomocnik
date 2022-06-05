<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Login form</title>
<?php include("top.php"); 
if($errors=null){
    $errors=[];
}

?>

<h1>Moj račun</h1>
Uporabniško ime: <?php echo json_encode($_SESSION['username']);?>
<form action="<?= BASE_URL . "username/edit" ?>" method="post">
    <input type="hidden" name="UID" value="<?= $_SESSION["UID"] ?>"  />
    <input type="text" name="newUsername" ?> 
    <span class="important"><?= $errors["newUsername"] ?></span>
    <button>Spremeni uporabniško ime</button>
</form><br>
<form action="<?= BASE_URL . "password/edit" ?>" method="post">
<input type="hidden" name="UID" value="<?= $_SESSION["UID"] ?>"  />
    <button>Spremeni geslo</button>
</form>


<?php include("bottom.php"); ?>
