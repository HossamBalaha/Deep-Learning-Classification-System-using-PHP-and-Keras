<?php
if (strcmp(realpath(__FILE__), $_SERVER["SCRIPT_FILENAME"]) == 0) {
  header("Location: /");
  return;
}
?>

<nav class=" navbar navbar-expand navbar-light bg-light navbar-modified">
  <a class="navbar-brand" href="#">
    <img src="<?php echo $configsArr['logo']; ?>"
         width="60" height="45" alt="" class="rounded-circle">
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link text-white" href="/controllers/user/index.php">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white"
           href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
          Classifications
        </a>
        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/controllers/user/classifications.php?op=create">Add New Classification</a>
          <a class="dropdown-item" href="/controllers/user/classifications.php">Classifications History</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/controllers/user/classifiers.php">Classifiers</a>
          <a class="dropdown-item" href="/controllers/user/classifiers.php?op=create">Add New Classifier</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white"
           href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
          <?php echo $_SESSION['user']['first_name']; ?>
          <?php echo $_SESSION['user']['last_name']; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/controllers/auth/logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>