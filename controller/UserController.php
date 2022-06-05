<?php
    session_start();

require_once("model/PredmetDB.php");
require_once("model/UserDB.php");
require_once("ViewHelper.php");

class UserController {

    public static function user($data = [], $errors = []) {
        //UserDB::getUID($_SESSION['username']);
        ViewHelper::render("view/user.php",$errors);
    }
    public static function showLoginForm() {
       ViewHelper::render("view/user-login-form.php");
    }

    public static function login() {
       if (UserDB::validLoginAttempt($_POST["username"], $_POST["password"])) {
            $vars = [
                "username" => $_POST["username"],
                "password" => $_POST["password"]
            ];
            $_SESSION['username'] = $_POST["username"];
            $_SESSION['UID'] = UserDB::getUID($_SESSION['username']);
            //echo("<script>console.log('kvadfuk: " . ($_SESSION['UID']) . "');</script>");

            //echo("<script>console.log('PHPppppppp: " . ($_SESSION['UID']) . "');</script>");
            //ViewHelper::redirect(BASE_URL . "user/login");
            ViewHelper::render("view/user-secret-page.php", $vars);
       } else {
            ViewHelper::render("view/user-login-form.php", [
                "errorMessage" => "Nepravilno uporaniško ime ali geslo."
            ]);
       }
    }

    public static function showusernameEditForm($data = [], $errors = []) {
        // If $data is an empty array, let's set some default values
        if (empty($data)) {
            $data = [
                "username" => "",
                "password" => ""
            ];
        }

        // If $errors array is empty, let's make it contain the same keys as
        // $data array, but with empty values
        if (empty($errors)) {
            foreach ($data as $key => $value) {
                $errors[$key] = "";
            }
        }
        $vars = ["user" => $data, "errors" => $errors];
        ViewHelper::render("view/user.php", $vars);
    }

    public static function usernameEdit() {
        $rules = [
            "username" => [
                // Only letters, dots, spaces and dashes are allowed
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[0-9a-zA-ZšđčćžŠĐČĆŽŠ]{4,20}$/"]
            ],
        ];
        $data = filter_input_array(INPUT_POST, $rules);

        $errors["username"] = $data["username"] === false ? "Nepravilno uporabniško ime. Minimalna dolžina je 4, maskimalna pa 20" : "";
        if(!USERDB::validRegisterAttempt($data["username"])){
            $errors["username"]="Uporabniško ime že obstaja";
        }
        $isDataValid = true;
        foreach ($errors as $error) {
            $isDataValid = $isDataValid && empty($error);
        }
        
        if ($isDataValid) {
            UserDB::usernameEdit($data["UID"],$data["username"]);
            ViewHelper::redirect(BASE_URL . "user");
        } else {
            self::showusernameEditForm($data, $errors);
        }
    }

    public static function register() {
        $rules = [
            "username" => [
                // Only letters, dots, spaces and dashes are allowed
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[0-9a-zA-ZšđčćžŠĐČĆŽŠ]{4,20}$/"]
            ],
            // we convert HTML special characters
            "password" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[0-9a-zA-ZšđčćžŠĐČĆŽŠ]{4,20}$/"]
            ],
        ];
        // Apply filter to all POST variables; from here onwards we never
        // access $_POST directly, but use the $data array
        $data = filter_input_array(INPUT_POST, $rules);

        $errors["username"] = $data["username"] === false ? "Nepravilno uporabniško ime. Minimalna dolžina je 4, maskimalna pa 20" : "";
        //$errors["username"] = USERDB::validRegisterAttempt($data["username"]) === false ? "Uporabniško ime že obstaja" : "";
        $errors["password"] = $data["password"] === false ? "Nepravilno geslo. Minimalna dolžina je 4, maskimalna pa 20" : "";
        
        if(!USERDB::validRegisterAttempt($data["username"])){
            $errors["username"]="Uporabniško ime že obstaja";
        }
        // Is there an error?
        $isDataValid = true;
        foreach ($errors as $error) {
            $isDataValid = $isDataValid && empty($error);
        }
        if ($isDataValid) {
            USERDB::insert($data["username"], $data["password"]);
            ViewHelper::render("view/register-secret-page.php");
        } else {
            self::showRegisterForm($data, $errors);
        }
    }

    public static function showRegisterForm($data = [], $errors = []) {
        // If $data is an empty array, let's set some default values
        if (empty($data)) {
            $data = [
                "username" => "",
                "password" => ""
            ];
        }

        // If $errors array is empty, let's make it contain the same keys as
        // $data array, but with empty values
        if (empty($errors)) {
            foreach ($data as $key => $value) {
                $errors[$key] = "";
            }
        }

        $vars = ["user" => $data, "errors" => $errors];
        ViewHelper::render("view/user-register-form.php", $vars);
    }

    public static function logout() {
        unset($_SESSION['username']);
        unset($_SESSION['UID']);
        ViewHelper::redirect(BASE_URL . "predmet");

    }
}