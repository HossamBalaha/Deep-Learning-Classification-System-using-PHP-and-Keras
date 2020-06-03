<?php
session_start();
include_once("../helpers/navigator.php");

if (!isset($_SESSION["user"])) {
  return redirect("/controllers/auth/login.php");
}

unset($_SESSION["user"]);
return redirect("/controllers/auth/login.php");