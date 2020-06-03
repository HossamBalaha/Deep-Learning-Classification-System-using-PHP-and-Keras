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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["op"])) {
  $op = $_GET["op"];
  if ($op == "create") {
    $types = Type::all();
    include_once("../../views/user/add-classifier.view.php");
  } else if ($op == "delete") {
    if (isset($_GET["target"])) {
      $target = $_GET["target"];
    } else {
      return redirect("/controllers/user/classifiers.php");
    }
    UserClassifier::delete($target);
    $_SESSION['success'] = "Classifier is removed successfully!";
    return redirect("/controllers/user/classifiers.php");
  } else {
    return redirect("/controllers/user/classifiers.php");
  }
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $userID = $_SESSION["user"]["id"];
  $userClassifiers = UserClassifier::userClassifiers($userID);
  include_once("../../views/user/classifiers.view.php");
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["op"])) {
  $op = $_GET["op"];
  if ($op = "create") {
    $fields = [
      "title" => [
        "ruleStr" => "required|maxLength:150|minLength:3|unique:user_classifiers,title",
        "data" => $_POST["title"],
        "name" => "Title",
      ],
      "type" => [
        "ruleStr" => "required",
        "data" => $_POST["type"],
        "name" => "Type",
      ],
      "description" => [
        "ruleStr" => "maxLength:1000",
        "data" => $_POST["description"],
        "name" => "Description",
      ],
      "model" => [
        "ruleStr" => "file|maxSize:1024|extension:hdf5",
        "data" => $_FILES["model"],
        "name" => "Model",
      ],
      "labels" => [
        "ruleStr" => "file|maxSize:10|extension:txt",
        "data" => $_FILES["labels"],
        "name" => "Labels",
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
      $type = Type::exists($fields["type"]['data']);
      if (!$type) {
        $_SESSION['errors'] = ["Select a correct type."];
        return returnBack();
      }

      $toInsert = [];
      foreach ($fields as $k => $field) {
        if ($k == "type") $newK = "type_id";
        else $newK = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $k));
        $toInsert[$newK] = $field["data"];
      }
      $toInsert["user_id"] = $_SESSION["user"]["id"];

      $encTime = md5(time());

      $newModelFileName = $encTime . ".hdf5";
      $isMoved = move_uploaded_file($_FILES["model"]["tmp_name"],
        "../../uploads/models/" . $newModelFileName);
      if (!$isMoved) {
        $_SESSION['errors'] = ["Something went wrong during uploading the model file."];
        return returnBack();
      }

      $newLabelsFileName = $encTime . ".dat";
      $isMoved = move_uploaded_file($_FILES["labels"]["tmp_name"],
        "../../uploads/models/" . $newLabelsFileName);
      if (!$isMoved) {
        $_SESSION['errors'] = ["Something went wrong during uploading the labels file."];
        return returnBack();
      }

      $toInsert["model"] = $newModelFileName;
      $toInsert["labels"] = $newLabelsFileName;
      UserClassifier::insert($toInsert);
      unset($_SESSION['errors']);
      unset($_SESSION['fields']);
      $_SESSION['success'] = "Classifier is created successfully!";
      return redirect("/controllers/user/classifiers.php");
    }
  } else {
    return redirect("/controllers/user/classifiers.php");
  }
} else {
  return redirect("/controllers/user/classifiers.php");
}


?>