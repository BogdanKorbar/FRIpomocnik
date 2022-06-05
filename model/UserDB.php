<?php

require_once "DBInit.php";

class UserDB {

    // Returns true if a valid combination of a username and a password are provided.
    public static function validLoginAttempt($username, $password) {
        $dbh = DBInit::getInstance();

        $query = "SELECT COUNT(UID) FROM uporabnik WHERE username = '$username'";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        if($stmt->fetchColumn(0) == 1){
            $query = "SELECT password FROM uporabnik WHERE username = '$username'";
            $stmt=$dbh->prepare($query);
            $stmt->execute();
            $hashed_password=$stmt->fetch();
            echo("<script>console.log('PHP: " .  ($hashed_password["password"]) . "');</script>");

            return password_verify($password, $hashed_password["password"]);
        }
        return false;
    }

    public static function getUID($username){
        $dbh = DBInit::getInstance();
        $query = "SELECT uid FROM uporabnik WHERE username = '$username'";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        //echo("<script>console.log('PHP: " . $result[0]["uid"] . "');</script>");
        return $result[0]["uid"];
    }

    public static function validRegisterAttempt($username) {
        $dbh = DBInit::getInstance();
        $query ="SELECT username FROM uporabnik";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach($result as $res){
            if($res["username"]==$username){
                //echo("<script>console.log('PHP: " . json_encode($res) . "');</script>");
                return false;
            }
        }
        //echo("<script>console.log('PHP: " . json_encode($result.ke) . "');</script>");
        //echo("<script>console.log('PHP: " . json_encode(in_array($username,$result)) . "');</script>");
        
        //$s[] = $stmt;
        return true;
    }

    public static function insert($username, $password) {
        $db = DBInit::getInstance();
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $statement = $db->prepare("INSERT INTO uporabnik (username, password) 
            VALUES (:username, :password)");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":password", $hashed_password);
        $statement->execute();
    }
    
    public static function usernameEdit($UID,$newUsername){
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE uporabnik SET username = :newusername 
            WHERE UID = :UID");
        $statement->bindParam(":newusername", $newUsername);
        $statement->bindParam(":UID", $UID);
        $statement->bindParam(":UID", $UID, PDO::PARAM_INT);
        $statement->execute();
    }

}
