<?php
session_start();
include_once("../helpers/configs.php");
include_once("../helpers/db.php");
include_once("../helpers/validator.php");
include_once("../helpers/navigator.php");
spl_autoload_register(function ($className) {
  include_once("../../models/" . $className . ".php");
});

if (!isset($_SESSION["user"])) {
  return redirect("/controllers/auth/login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  include_once("../../views/user/index.view.php");
} else {
  return redirect("/");
}
?>