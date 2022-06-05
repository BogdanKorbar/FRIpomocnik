<?php

require_once("model/PredmetDB.php");
require_once("ViewHelper.php");

class PredmetController {

    public static function index() {
        if (isset($_GET["PID"])) {
            //echo("<script>console.log('PHP: " . json_encode(PredmetDB::get($_GET["PID"])) . "');</script>");
            ViewHelper::render("view/predmet-detail.php", ["predmet" => PredmetDB::get($_GET["PID"])]);
        } else{
            ViewHelper::render("view/predmet-list.php", ["predmeti" => []]);
        }
    }

    public static function showEditForm($data = [], $errors = []) {
        if (empty($data)) {
            $data = PredmetDB::get($_GET["PID"]);
        }

        if (empty($errors)) {
            foreach ($data as $key => $value) {
                $errors[$key] = "";
            }
        }

        ViewHelper::render("view/predmet-edit.php", ["predmet" => $data, "errors" => $errors]);
    }  

    public static function edit() {
        $rules = [
            "PID" => [
                FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[ 0-9]{1,}$/"]],
            "naziv" => [
                // Only letters, dots, spaces and dashes are allowed
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[ 0-9a-zA-ZšđčćžŠĐČĆŽŠ]{1,20}$/"]
            ],
            // we convert HTML special characters
            "opis" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^.{1,100}$/"]
            ],
            "kratica" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[ 0-9a-zA-ZšđčćžŠĐČĆŽŠ\.\-]{1,4}$/"]
            ],
        ];
        $data = filter_input_array(INPUT_POST, $rules);

        $errors["naziv"] = $data["naziv"] === false ? "Nepravilen naziv" : "";
        $errors["opis"] = $data["opis"] === false ? "Nepravilen opis" : "";
        $errors["kratica"] = $data["kratica"] === false ? "Nepravilna kratica" : "";

        echo("<script>console.log('PHP: " . json_encode($errors) . "');</script>");

        $isDataValid = true;
        foreach ($errors as $error) {
            $isDataValid = $isDataValid && empty($error);
        }
        
        if ($isDataValid) {
            PredmetDB::update($data["PID"], $data["naziv"], $data["opis"], $data["kratica"]);
            ViewHelper::redirect(BASE_URL . "predmet?id=" . $data["PID"]);
        } else {
            self::showEditForm($data, $errors);
        }
    }

    public static function showAddForm($data = [], $errors = []) {
        // If $data is an empty array, let's set some default values
        if (empty($data)) {
            $data = [
                "naziv" => "",
                "opis" => "",
                "kratica" => ""
            ];
        }

        // If $errors array is empty, let's make it contain the same keys as
        // $data array, but with empty values
        if (empty($errors)) {
            foreach ($data as $key => $value) {
                $errors[$key] = "";
            }
        }

        $vars = ["predmet" => $data, "errors" => $errors];
        ViewHelper::render("view/predmet-add.php", $vars);
    }

    public static function add() {
        $rules = [
            "naziv" => [
                // Only letters, dots, spaces and dashes are allowed
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[ 0-9a-zA-ZšđčćžŠĐČĆŽŠ]{1,30}$/"]
            ],
            // we convert HTML special characters
            "opis" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^.{1,100}$/"]
            ],
            "kratica" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[ 0-9a-zA-ZšđčćžŠĐČĆŽŠ\.\-]{1,4}$/"]
            ],
        ];
        // Apply filter to all POST variables; from here onwards we never
        // access $_POST directly, but use the $data array
        $data = filter_input_array(INPUT_POST, $rules);

        $errors["naziv"] = $data["naziv"] === false ? "Nepravilen naziv" : "";
        $errors["opis"] = $data["opis"] === false ? "Nepravilen opis" : "";
        $errors["kratica"] = $data["kratica"] === false ? "Nepravilna kratica" : "";

        // Is there an error?
        $isDataValid = true;
        foreach ($errors as $error) {
            $isDataValid = $isDataValid && empty($error);
        }

        if ($isDataValid) {
            PredmetDB::insert($data["naziv"], $data["opis"], $data["kratica"]);
            ViewHelper::redirect(BASE_URL . "predmet");
        } else {
            self::showAddForm($data, $errors);
        }
    }

    public static function delete() {
        $rules = [
            "PID" => [
                "filter" => FILTER_VALIDATE_INT,
                "options" => ["min_range" => 1]
            ]
        ];
        $data = filter_input_array(INPUT_POST, $rules);
        $errors["PID"] = $data["PID"] === null ? "Nepravilen ID." : "";

        $isDataValid = true;
        foreach ($errors as $error) {
            $isDataValid = $isDataValid && empty($error);
        }
        
        if ($isDataValid) {
            PredmetDB::delete($data["PID"]);
            $url = BASE_URL . "predmet";
            
        } else {
            
            if ($data["PID"] !== null) {
                $url = BASE_URL . "predmet/edit?PID=" . $data["PID"];
            } else {
                $url = BASE_URL . "predmet";
            }
        }

        ViewHelper::redirect($url);
    }

    public static function obiskuje() {
        if(isset($_SESSION['UID'])){    //ČE ŽE OBISKUJE
            $data = $_POST;
            if(in_array($data["IzberiPredmet"],PredmetDB::getAllFromUID($_SESSION['UID']))){
                ViewHelper::render("view/predmet-list.php", ["predmeti" => []]);
                return;
            }
            //echo("<script>console.log('PHP: " . ($_SESSION['UID']) . "');</script>");
            PredmetDB::obiskuje($_SESSION['UID'],$data["IzberiPredmet"]);
            ViewHelper::redirect(BASE_URL . "predmet");
        }
    }

    public static function neObiskuje() {
        if(isset($_SESSION['UID'])){    
            $data = $_POST;
            //echo("<script>console.log('PHP: " . ($_SESSION['UID']) . "');</script>");
            PredmetDB::neObiskuje($_SESSION['UID'],$data["PID"]);
            ViewHelper::redirect(BASE_URL . "predmet");
        }
    }
}