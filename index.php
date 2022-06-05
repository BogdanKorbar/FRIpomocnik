<?php
require_once("ViewHelper.php");
require_once("controller/PredmetController.php");
require_once("controller/UserController.php");
require_once("controller/OcenaController.php");
require_once("controller/DogodekController.php");


define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";
$urls = [
    "" => function () {
        ViewHelper::redirect(BASE_URL . "predmet");
    },
    "predmet" => function () {
        PredmetController::index();
    },
    "predmet/edit" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            PredmetController::edit();
        } else {
            PredmetController::showEditForm();
        }
    },
    "predmet/add" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            PredmetController::add();
        } else {
            PredmetController::showAddForm();
        }
    },
    "predmet/delete" => function () {
        PredmetController::delete();
    },
    "obiskuje" => function () {
        PredmetController::obiskuje();
    },
    "neObiskuje" => function() {
        PredmetController::neObiskuje();
    },
    "user" => function() {
        UserController::user();
    },
    "username/edit" => function() {
        UserController::usernameEdit();
    },
    "password/edit" => function() {
        UserController::passwordEdit();
    },
    "user/login" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::login();
        } else {
            UserController::showLoginForm();
        }
    },
    "user/register" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::register();
        } else {
            UserController::showRegisterForm();
        }
    },
    "user/logout" => function() {
        UserController::logout();
    },
    "ocene" => function() {
        OcenaController::ocene();
    },
    "ocene/add" => function() {
        OcenaController::add();
    },
    "ocene/delete" => function() {
        OcenaController::delete();
    },
    "dogodki" => function() {
        DogodekController::dogodki();
    },
    "dogodki/add" => function() {
        DogodekController::add();
    },
    "dogodki/delete" => function() {
        DogodekController::delete();
    }
    
];

try {
    if (isset($urls[$path])) {
        if(!isset($_SESSION['username'])){
            if($path==""||$path=="predmet"||$path=="user/login"||$path=="user/register"){
            }
            else{
                UserController::showLoginForm();
                return;
            }
        }            //echo("<script>console.log('PHP: " . json_encode($_SESSION['username']) . "');</script>");
        //echo("<script>console.log('PHP: " . ($_SESSION['UID']) . "');</script>");
        $urls[$path]();
    } else {
        echo "No controller for '$path'";
    }
} catch (Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
    // ViewHelper::error404();
} 