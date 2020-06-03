<?php
if (strcmp(realpath(__FILE__), $_SERVER["SCRIPT_FILENAME"]) == 0) {
  header("Location: /");
  return;
}
?>

<?php include_once("common/top.view.php"); ?>
<?php include_once("common/navbar.view.php"); ?>
<?php include_once("common/success.view.php"); ?>
<?php include_once("common/errors.view.php"); ?>

<div class="container my-5">
  <div class="row">
    <div class="col-12">
      <h1 class="display-5">
        Dashboard
      </h1>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-md-6">
      <a href="/controllers/user/classifiers.php" class="a-no-link">
        <div class="card shadow">
          <div class="card-body">
            <p class="text-center m-0 display-7 my-3">
              Classifiers
            </p>
            <p class="text-center m-0 text-muted">
              <?php $count = count(UserClassifier::userClassifiers($_SESSION['user']['id'])); ?>
              You have <?php echo $count; ?> item<?php echo $count > 1 ? "s" : ""; ?>.
            </p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-12 col-md-6">
      <a href="/controllers/user/classifications.php" class="a-no-link">
        <div class="card shadow">
          <div class="card-body">
            <p class="text-center m-0 display-7 my-3">
              Classification History
            </p>
            <p class="text-center m-0 text-muted">
              <?php $count = count(UserHistory::userClassifications($_SESSION['user']['id'])); ?>
              You have <?php echo $count; ?> item<?php echo $count > 1 ? "s" : ""; ?>.
            </p>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>

<?php include_once("common/bottom.view.php"); ?>
