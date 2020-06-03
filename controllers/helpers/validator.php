<?php
if (strcmp(realpath(__FILE__), $_SERVER["SCRIPT_FILENAME"]) == 0) {
  header("Location: /");
  return;
}

spl_autoload_register(function ($className) {
  include_once("../../models/$className.php");
});

function validateMinLength($data, $length)
{
  return strlen($data) >= $length;
}

function validateMaxLength($data, $length)
{
  return strlen($data) <= $length;
}

function validateMaxSize($data, $length)
{
  return $data["size"] / (1024 ** 2) <= $length;
}

function validateRequired($data)
{
  return isset($data) && validateMinLength($data, 1);
}

function validateFile($data)
{
  return isset($data) && $data && !$data["error"];
}

function validateEmail($data)
{
  return filter_var($data, FILTER_VALIDATE_EMAIL);
}

function validateNumeric($data)
{
  return is_numeric($data);
}

function validateMatch($data, $data2)
{
  return strcmp($data, $data2) == 0;
}

function validateExtensions($data, $extensions)
{
  $name = $data["name"];
  $ext = pathinfo($name, PATHINFO_EXTENSION);
  foreach ($extensions as $extension) {
    if ($extension == $ext) return true;
  }
  return false;
}

function validateUnique($data, $tableName, $columnName)
{
  $className = ucfirst($tableName);
  if ($className[strlen($className) - 1] == "s") {
    $className = str_split($className, strlen($className) - 1)[0];
    $className = ucwords($className);
    $classNameParts = explode("_", $className);
    $className = implode("", $classNameParts);
  }
  return $className::isUnique($columnName, $data);
}

function sanitize($fields)
{
  foreach ($fields as $k => $field) {
    $fields[$k]['data'] = isset($field['data']) ? $field['data'] : null;
  }
  return $fields;
}

function validate($fields)
{
  $errors = [];
  foreach ($fields as $field) {
    $data = $field['data'];
    $name = $field['name'];
    $ruleStr = $field['ruleStr'];
    $rules = explode("|", $ruleStr);
    foreach ($rules as $rule) {
      if ($rule == "required") {
        if (!validateRequired($data)) {
          array_push($errors, "{$name} is required.");
          break;
        }
      } else if ($rule == "file") {
        if (!validateFile($data)) {
          array_push($errors, "{$name} is required to be a file.");
          break;
        }
      } else if (strpos($rule, "maxSize") !== false) {
        $parts = explode(":", $rule);
        if (!validateMaxSize($data, $parts[1])) {
          array_push($errors, "{$name} size must be less than or equal {$parts[1]} MB.");
          break;
        }
      } else if (strpos($rule, "maxLength") !== false) {
        $parts = explode(":", $rule);
        if (!validateMaxLength($data, $parts[1])) {
          array_push($errors, "{$name} length must be less than or equal {$parts[1]} characters.");
          break;
        }
      } else if (strpos($rule, "minLength") !== false) {
        $parts = explode(":", $rule);
        if (!validateMinLength($data, $parts[1])) {
          array_push($errors, "{$name} length must be more than or equal {$parts[1]} characters.");
          break;
        }
      } else if ($rule == "email") {
        if (!validateEmail($data)) {
          array_push($errors, "{$name} is not valid.");
          break;
        }
      } else if (strpos($rule, "match") !== false) {
        $parts = explode(":", $rule);
        $matchField = $fields[$parts[1]];
        if (!validateMatch($data, $matchField['data'])) {
          array_push($errors, "{$name} and {$matchField['name']} do not match.");
          break;
        }
      } else if (strpos($rule, "unique") !== false) {
        $parts = explode(":", $rule);
        $subParts = explode(",", $parts[1]);
        $tableName = $subParts[0];
        $columnName = $subParts[1];
        if (!validateUnique($data, $tableName, $columnName)) {
          array_push($errors, "{$name} is used previously.");
          break;
        }
      } else if (strpos($rule, "extension") !== false) {
        $parts = explode(":", $rule);
        $extensions = explode(",", $parts[1]);
        if (!validateExtensions($data, $extensions)) {
          array_push($errors, "{$name} extension is not valid. Allowed type(s): ({$parts[1]}).");
          break;
        }
      }
    }
  }
  return $errors;
}

function sanitizeAndValidate($fields)
{
  $fields = sanitize($fields);
  $errors = validate($fields);
  return [
    'errors' => $errors,
    'fields' => $fields,
  ];
}