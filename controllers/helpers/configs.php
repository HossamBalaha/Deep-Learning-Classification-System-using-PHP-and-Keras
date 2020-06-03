<?php
if (strcmp(realpath(__FILE__), $_SERVER["SCRIPT_FILENAME"]) == 0) {
  header("Location: /");
  return;
}

include_once("db.php");

$sql = "SELECT * FROM website_configurations;";
$stmt = $pdo->query($sql);
$configs = $stmt->fetchAll(PDO::FETCH_ASSOC);
$configsArr = [];
foreach ($configs as $config) {
  $configsArr[$config['config_key']] = $config['config_value'];
}

$sql = "SELECT * FROM website_slider;";
$stmt = $pdo->query($sql);
$sliderItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM website_cards ORDER BY id ASC LIMIT 0, 4;";
$stmt = $pdo->query($sql);
$cardItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>