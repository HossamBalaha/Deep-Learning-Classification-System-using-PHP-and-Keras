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
    $userID = $_SESSION["user"]["id"];
    $userClassifiers = UserClassifier::userClassifiers($userID);
    include_once("../../views/user/add-classification.view.php");
  } else {
    return redirect("/controllers/user/classifications.php");
  }
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $userID = $_SESSION["user"]["id"];
  $userClassifications = UserHistory::userClassifications($userID);
  include_once("../../views/user/classifications.view.php");
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["op"])) {
  $op = $_GET["op"];
  if ($op = "create") {
    $userID = $_SESSION["user"]["id"];
    $type = UserClassifier::type($userID, $_POST["classifier"]);
    if (!$type) {
      $_SESSION['errors'] = ["Select a correct classifier."];
      return returnBack();
    }

    $userID = $_SESSION["user"]["id"];
    $classifier = UserClassifier::classifier($userID, $_POST["classifier"]);
    if (!$classifier) {
      $_SESSION['errors'] = ["Select a correct classifier."];
      return returnBack();
    }

    $fields = [
      "classifier" => [
        "ruleStr" => "required",
        "data" => $_POST["classifier"],
        "name" => "Classifier",
      ],
      "file" => [
        "ruleStr" => "file|maxSize:50|extension:" . $type['allowed_extensions'],
        "data" => $_FILES["file"],
        "name" => "File",
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
        if ($k == "classifier") $newK = "user_classifier_id";
        else $newK = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $k));
        $toInsert[$newK] = $field["data"];
      }

      $encTime = md5(time());
      $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

      $newFileName = $encTime . "." . $ext;
      $isMoved = move_uploaded_file($_FILES["file"]["tmp_name"],
        "../../uploads/history/" . $newFileName);
      if (!$isMoved) {
        $_SESSION['errors'] = ["Something went wrong during uploading the file."];
        return returnBack();
      }

      if ($type['id'] == 1) { // Images
        try {
          $pythonFile = realpath("../python/image.py");
          $modelFile = realpath("../../uploads/models/" . $classifier['model']);
          $labelsFile = realpath("../../uploads/models/" . $classifier['labels']);
          $imageFile = realpath("../../uploads/history/" . $newFileName);
          $cmd = 'conda run -n tf-gpu python "' . $pythonFile . '" "' . $modelFile . '" "' .
            $imageFile . '" "' . $labelsFile . '"';
          $command = escapeshellcmd($cmd);
          $output = shell_exec($command);
          $output = json_decode($output);
          $outputStr = "";
          foreach ($output as $k => $el) {
            $outputStr .= $el[0] . ": " . $el[1] . "%\n";
          }
          $toInsert["output"] = $outputStr;
        } catch (Exception $ex) {
          $_SESSION['errors'] = ["Something went wrong during classification."];
          return returnBack();
        }
      } else {
        $_SESSION['errors'] = ["Current classification type is not supported currently."];
        return returnBack();
      }

      $toInsert["original_name"] = $_FILES["file"]["name"];
      $toInsert["file"] = $newFileName;
      UserHistory::insert($toInsert);
      unset($_SESSION['errors']);
      unset($_SESSION['fields']);
      $_SESSION['success'] = "Classification is done successfully!";
      return redirect("/controllers/user/classifications.php");
    }
  } else {
    return redirect("/controllers/user/classifications.php");
  }
} else {
  return redirect("/controllers/user/classifications.php");
}


?>