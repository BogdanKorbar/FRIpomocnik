<?php

require_once "DBInit.php";

class PredmetDB {

    public static function getAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT PID,naziv,opis,kratica 
            FROM predmet");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getAllFromUID($UID){
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT PID 
        FROM obiskuje WHERE UID = $UID");
        $statement->execute();
        $pids=$statement->fetchAll();
        $arr=[];
        //echo("<script>console.log('PHPppppp: " . gettype(json_encode($pids[0])) . "');</script>");

        foreach ($pids as $pid){
            //echo("<script>console.log('PHPppppp: " . gettype(json_encode($pid)) . "');</script>");
            preg_match_all('!\d+!', json_encode($pid), $p);
            //echo("<script>console.log('PHPppppp: " . json_encode($p[0][0]) . "');</script>");
            array_push($arr,PredmetDB::get($p[0][0]));
        }
        //echo("<script>console.log('PHP: " . json_encode($arr) . "');</script>");

        //echo("<script>console.log('PHP: " . json_encode($statement->fetchAll()) . "');</script>");
        return $arr;
    }

    public static function get($PID) {
        $db = DBInit::getInstance();
        //echo("<script>console.log('PHPpp: " . json_encode($PID) . "');</script>");

        $statement = $db->prepare("SELECT PID,naziv,opis,kratica 
        FROM predmet WHERE PID = :PID");
        $statement->bindParam(":PID", $PID, PDO::PARAM_INT);
        $statement->execute();

        $predmet = $statement->fetch();
        //echo("<script>console.log('PHPpp: " . json_encode($predmet) . "');</script>");

        if ($predmet != null) {
            return $predmet;
        } else {
            throw new InvalidArgumentException("No record with id $PID");
        }
    }

    public static function update($PID, $naziv, $opis, $kratica) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE predmet SET naziv = :naziv, opis = :opis, kratica = :kratica 
            WHERE PID = :PID");
        $statement->bindParam(":naziv", $naziv);
        $statement->bindParam(":opis", $opis);
        $statement->bindParam(":kratica", $kratica);
        $statement->bindParam(":PID", $PID, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function insert($naziv, $opis, $kratica) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO predmet (naziv, opis, kratica) 
            VALUES (:naziv, :opis, :kratica)");
        $statement->bindParam(":naziv", $naziv);
        $statement->bindParam(":opis", $opis);
        $statement->bindParam(":kratica", $kratica);
        $statement->execute();
    }

    public static function delete($PID) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("DELETE FROM predmet WHERE PID = :PID");
        $statement->bindParam(":PID", $PID, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function obiskuje($UID, $PID) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("INSERT INTO obiskuje (`UID`, `PID`) 
            VALUES (:UID, :PID)");
        $statement->bindParam(":UID", $UID, PDO::PARAM_INT);
        $statement->bindParam(":PID", $PID, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function neObiskuje($UID, $PID) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("DELETE FROM obiskuje WHERE PID = :PID and UID = :UID");
        $statement->bindParam(":PID", $PID, PDO::PARAM_INT);
        $statement->bindParam(":UID", $UID, PDO::PARAM_INT);
        $statement->execute();
    }
}
