<?php

require_once("model/PredmetDB.php");
require_once("model/UserDB.php");
require_once("model/DogodekDB.php");
require_once("ViewHelper.php");

class DogodekController {
    public static function dogodki() {
        ViewHelper::render("view/dogodki.php");
    }

    public static function add() {
        if(isset($_SESSION['UID'])){    
            $data = $_POST;
            //echo("<script>console.log('PHP: " . json_encode($data["IzberiPredmet"]) . "');</script>");
            DogodekDB::add($data["opis"],$data["datum"],$data["predmet"],$_SESSION['UID']);
            ViewHelper::redirect(BASE_URL . "dogodki");
        }
    }
    public static function delete(){
        if(isset($_SESSION['UID'])){    
            $data = $_POST;
            //echo("<script>console.log('PHP: " . json_encode($data["OID"]) . "');</script>");
            DogodekDB::delete($data["DID"]);
            ViewHelper::redirect(BASE_URL . "dogodki");
        }
    }

}