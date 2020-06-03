<?php
if (strcmp(realpath(__FILE__), $_SERVER["SCRIPT_FILENAME"]) == 0) {
  header("Location: /");
  return;
}

class UserClassifier extends Table
{
  public static $table = "user_classifiers";

  static function userClassifiers($userID)
  {
    $sql = "SELECT B.*, C.name FROM " . User::$table . " AS A, " . UserClassifier::$table .
      " AS B, " . Type::$table . " AS C WHERE A.id = B.user_id AND C.id = B.type_id AND A.id=$userID;";
    $stmt = $GLOBALS["pdo"]->query($sql);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $records;
  }

  static function type($userID, $classifier)
  {
    $sql = "SELECT C.* FROM " . User::$table . " AS A, " . UserClassifier::$table .
      " AS B, " . Type::$table . " AS C WHERE A.id = B.user_id AND C.id = B.type_id AND A.id=:u AND B.id=:c;";
    $stmt = $GLOBALS["pdo"]->prepare($sql);
    $stmt->execute([":u" => $userID, ":c" => $classifier]);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    return $record;
  }

  static function classifier($userID, $classifier)
  {
    $sql = "SELECT B.* FROM " . User::$table . " AS A, " . UserClassifier::$table .
      " AS B, " . Type::$table . " AS C WHERE A.id = B.user_id AND C.id = B.type_id AND A.id=:u AND B.id=:c;";
    $stmt = $GLOBALS["pdo"]->prepare($sql);
    $stmt->execute([":u" => $userID, ":c" => $classifier]);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    return $record;
  }
}