<?php
if (strcmp(realpath(__FILE__), $_SERVER["SCRIPT_FILENAME"]) == 0) {
  header("Location: /");
  return;
}

class User extends Table
{
  public static $table = "users";

  static function login($username, $password)
  {
    $sql = "SELECT * FROM " . User::$table . " WHERE username=:u LIMIT 0, 1;";
    $stmt = $GLOBALS["pdo"]->prepare($sql);
    $stmt->execute([":u" => $username]);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($record && password_verify($password, $record["password"])) {
      unset($record["password"]);
      return $record;
    }
    return false;
  }
}