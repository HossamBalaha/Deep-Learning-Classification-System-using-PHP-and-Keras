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
    "firstName" => [
      "ruleStr" => "required|maxLength:75",
      "data" => $_POST["firstName"],
      "name" => "First name",
    ],
    "lastName" => [
      "ruleStr" => "maxLength:75",
      "data" => $_POST["lastName"],
      "name" => "Last name",
    ],
    "username" => [
      "ruleStr" => "required|maxLength:150|minLength:6|unique:users,username",
      "data" => $_POST["username"],
      "name" => "Username",
    ],
    "email" => [
      "ruleStr" => "required|maxLength:150|minLength:6|email|unique:users,email",
      "data" => $_POST["email"],
      "name" => "Email",
    ],
    "password" => [
      "ruleStr" => "required|maxLength:150|minLength:6|match:rePassword",
      "data" => $_POST["password"],
      "name" => "Password",
    ],
    "rePassword" => [
      "ruleStr" => "required|maxLength:150|minLength:6",
      "data" => $_POST["rePassword"],
      "name" => "Retype password",
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
    $toInsert = [];
    foreach ($fields as $k => $field) {
      if ($k == "rePassword") continue;
      $newK = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $k));
      $toInsert[$newK] = $field["data"];
    }
    $toInsert["password"] = password_hash($toInsert["password"], PASSWORD_BCRYPT);
    User::insert($toInsert);
    unset($_SESSION['errors']);
    unset($_SESSION['fields']);
    $_SESSION['success'] = "Account is created successfully!";
    return redirect("/controllers/auth/login.php");
  }
}


include_once("../../views/general/register.view.php");
unset($_SESSION['fields']);
?>