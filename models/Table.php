<?php
if (strcmp(realpath(__FILE__), $_SERVER["SCRIPT_FILENAME"]) == 0) {
  header("Location: /");
  return;
}

class Table
{
  public static $table = null;

  static function all()
  {
    $sql = "SELECT * FROM " . static::$table . " ORDER BY id ASC;";
    $stmt = $GLOBALS["pdo"]->query($sql);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $records;
  }

  static function count()
  {
    return count(static::all());
  }

  static function delete($targetID)
  {
    $sql = "DELETE FROM " . static::$table . " WHERE id=:id;";
    $stmt = $GLOBALS["pdo"]->prepare($sql);
    $stmt->execute([':id' => $targetID]);
  }

  static function isUnique($column, $value)
  {
    $sql = "SELECT COUNT(*) as K FROM " . static::$table . " WHERE $column=:v;";
    $stmt = $GLOBALS["pdo"]->prepare($sql);
    $stmt->execute([':v' => $value]);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    return $record["K"] <= 0;
  }

  static function insert($fields)
  {
    $columns = [];
    $data = [];
    $holders = [];
    foreach ($fields as $k => $field) {
      array_push($columns, $k);
      array_push($holders, ":" . $k);
      $data[":" . $k] = trim($field);
    }
    $columnsStr = implode(",", $columns);
    $holdersStr = implode(",", $holders);
    $sql = "INSERT INTO " . static::$table . "($columnsStr) VALUES ($holdersStr);";
    $stmt = $GLOBALS["pdo"]->prepare($sql);
    $stmt->execute($data);
    return $GLOBALS["pdo"]->lastInsertId();
  }
}