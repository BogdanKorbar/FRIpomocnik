<?php

require_once "DBInit.php";

class OcenaDB {
    public static function add($cifra, $opis, $UID, $PID) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("INSERT INTO ocena (`cifra`, `opis`, `UID`, `PID`) 
            VALUES (:cifra, :opis, :UID, :PID)");
        $statement->bindParam(":cifra", $cifra);
        $statement->bindParam(":opis", $opis);
        $statement->bindParam(":UID", $UID, PDO::PARAM_INT);
        $statement->bindParam(":PID", $PID, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function getOcene($UID) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT OID, cifra, opis, PID FROM ocena WHERE UID=:UID");
        $statement->bindParam(":UID", $UID, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    public static function delete($OID) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("DELETE FROM ocena WHERE OID=:OID");
        $statement->bindParam(":OID", $OID, PDO::PARAM_INT);
        $statement->execute();
    }
}