<?php
session_start();
include_once("../helpers/configs.php");
include_once("../helpers/db.php");
include_once("../helpers/validator.php");
include_once("../helpers/navigator.php");
spl_autoload_register(function ($className) {
  include_once("../../models/" . strtolower($className) . ".php");
});

if (isset($_SESSION["user"])) {
  return redirect("/controllers/user/index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fields = [
    "username" => [
      "ruleStr" => "required|maxLength:150|minLength:6",
      "data" => $_POST["username"],
      "name" => "Username",
    ],
    "password" => [
      "ruleStr" => "required|maxLength:150|minLength:6",
      "data" => $_POST["password"],
      "name" => "Password",
    ],
  ];
  $result = sanitizeAndValidate($fields);
  $errors = $result['errors'];
  $fields = $result['fields'];
  $_SESSION['fields'] = $fields;
  $_SESSION['errors'] = $errors;
  if (count($errors) > 0) {
    return returnBack();
  } else {
    $username = $fields["username"]["data"];
    $password = $fields["password"]["data"];
    $user = User::login($username, $password);
    if ($user) {
      unset($_SESSION['errors']);
      unset($_SESSION['fields']);
      $_SESSION['success'] = "You logged in successfully!";
      $_SESSION["user"] = $user;
      return redirect("/controllers/user/index.php");
    } else {
      $_SESSION['errors'] = ["Wrong username and/or password!"];
      return redirect("/controllers/auth/login.php");
    }
  }
}

include_once("../../views/general/login.view.php");
unset($_SESSION['fields']);
?>