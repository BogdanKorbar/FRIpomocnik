<?php
$adm=false;
if(isset($_SESSION['username']) and $_SESSION['username']=="admin"){
    $adm=true;
}?>
<header>
    <img src="logo.png" alt="Logo">
    <h1>FRI pomočnik</h1>
</header>
<nav>
    <a href=<?= BASE_URL."predmet" ?>>Glavna stran</a><?php
    if(!$adm):?> |
    <a href="<?=BASE_URL."dogodki"?>">Dogodki</a> |
    <a href="<?=BASE_URL."ocene"?>">Redovalnica</a>
    <?php endif ?>
    <div id="desnnav">
        
        <?php

        if(isset($_SESSION['username'])){
            //echo("<script>console.log('PHP: " . json_encode($_SESSION['username']) . "');</script>");
            echo "Prijavljen kot (".$_SESSION['username'].")  ";
            //echo "<a href=".BASE_URL."user>Moj račun</a>";
            echo "     ";
            echo "<a href=".BASE_URL."user/logout>Odjava</a>";
            //echo "<a id='mojracun' href=" . BASE_URL . 'user'>Moj račun</a>;
            //echo "<a id='mojracun' href= . BASE_URL . 'user>Moj račun</a>";
        }
        else {
            echo "<a href=" . BASE_URL . "user/login>Vpis</a> |
            <a href=" . BASE_URL . "user/register>Registracija</a>";
        }
        ?>
    </div>
</nav>