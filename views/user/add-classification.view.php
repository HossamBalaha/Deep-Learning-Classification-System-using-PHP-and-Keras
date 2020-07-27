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
        Add New Classification
      </h1>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/controllers/user/index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="/controllers/user/classifications.php">User Classifications</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add New Classification</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-body">
          <form action="/controllers/user/classifications.php?op=create"
                enctype="multipart/form-data" method="POST">
            <div class="form-group row">
              <label for="classifier" class="col-12 col-form-label col-md-2 font-weight-bold">
                Classifier
              </label>
              <div class="col-12 col-md-10">
                <select name="classifier" id="classifier" class="form-control">
                  <?php foreach ($userClassifiers as $k => $userClassifier) { ?>
                    <option value="<?php echo $userClassifier['id']; ?>"
                      <?php echo isset($_SESSION["fields"]) && ($userClassifier['id'] == $_SESSION["fields"]["classifier"]["data"]) ? "selected" : ""; ?>>
                      <?php echo $userClassifier['title']; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="file" class="col-12 col-form-label col-md-2 font-weight-bold">
                File
              </label>
              <div class="col-12 col-md-10">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" required
                         name="file" id="file">
                  <label class="custom-file-label" for="file">Choose the file to classify...</label>
                </div>
              </div>
            </div>
            <div class="text-center">
              <button class="btn btn-success px-4 submit" type="submit">
                Classify
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once("common/bottom.view.php"); ?>
