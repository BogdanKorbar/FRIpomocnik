<?php

require_once "DBInit.php";

class DogodekDB {
    public static function getDogodke($UID) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT DID, opis, datum, PID FROM dogodek WHERE UID=:UID");
        $statement->bindParam(":UID", $UID, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    public static function add($opis, $datum, $PID, $UID) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("INSERT INTO dogodek (`opis`, `datum`, `PID`, `UID`) 
            VALUES (:opis, :datum, :PID, :UID)");
        $statement->bindParam(":opis", $opis);
        $statement->bindParam(":datum", $datum);
        $statement->bindParam(":PID", $PID, PDO::PARAM_INT);
        $statement->bindParam(":UID", $UID, PDO::PARAM_INT);

        $statement->execute();
    }

    public static function delete($DID) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("DELETE FROM dogodek WHERE DID=:DID");
        $statement->bindParam(":DID", $DID, PDO::PARAM_INT);
        $statement->execute();
    }
}