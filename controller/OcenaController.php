<?php

require_once("model/PredmetDB.php");
require_once("model/UserDB.php");
require_once("model/OcenaDB.php");
require_once("ViewHelper.php");

class OcenaController {
    public static function add() {
        if(isset($_SESSION['UID'])){    
            $data = $_POST;
            //echo("<script>console.log('PHP: " . json_encode($data["IzberiPredmet"]) . "');</script>");
            OcenaDB::add($data["cifra"],$data["opis"],$_SESSION['UID'],$data["predmet"]);
            ViewHelper::redirect(BASE_URL . "ocene");
        }
    }
    public static function ocene(){
        ViewHelper::render("view/ocene.php");
    }
    public static function delete(){
        if(isset($_SESSION['UID'])){    
            $data = $_POST;
            //echo("<script>console.log('PHP: " . json_encode($data["OID"]) . "');</script>");
            OcenaDB::delete($data["OID"]);
            ViewHelper::redirect(BASE_URL . "ocene");
        }
    }

}