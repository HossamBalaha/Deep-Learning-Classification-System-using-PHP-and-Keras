<?php
if (strcmp(realpath(__FILE__), $_SERVER["SCRIPT_FILENAME"]) == 0) {
  header("Location: /");
  return;
}

function returnBack()
{
  header("Location: " . $_SERVER["REQUEST_URI"]);
  return;
}

function redirect($link)
{
  header("Location: " . $link);
  return;
}

?>