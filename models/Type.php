<?php
if (strcmp(realpath(__FILE__), $_SERVER["SCRIPT_FILENAME"]) == 0) {
  header("Location: /");
  return;
}

class Type extends Table
{
  public static $table = "types";

  static function exists($id)
  {
    $sql = "SELECT COUNT(*) AS K FROM " . static::$table . " WHERE id=:id;";
    $stmt = $GLOBALS["pdo"]->prepare($sql);
    $stmt->execute([':id' => $id]);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    return $record && $record["K"] > 0;
  }
}