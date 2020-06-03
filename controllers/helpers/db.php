<?php
if (strcmp(realpath(__FILE__), $_SERVER["SCRIPT_FILENAME"]) == 0) {
  header("Location: /");
  return;
}

define("DB_NAME", "hmb_dl_php_keras");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_HOST", "localhost");
define("DB_PORT", "3306");

$pdo = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME,
  DB_USER, DB_PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);