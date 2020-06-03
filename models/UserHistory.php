<?php
if (strcmp(realpath(__FILE__), $_SERVER["SCRIPT_FILENAME"]) == 0) {
  header("Location: /");
  return;
}

class UserHistory extends Table
{
  public static $table = "user_history";

  static function userClassifications($userID)
  {
    $sql = "SELECT D.*, B.title FROM " . User::$table . " AS A, " . UserClassifier::$table .
      " AS B, " . Type::$table . " AS C, " . UserHistory::$table .
      " AS D WHERE A.id = B.user_id AND B.id = D.user_classifier_id AND C.id = B.type_id AND A.id=$userID;";
    $stmt = $GLOBALS["pdo"]->query($sql);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $records;
  }
}