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
        Add New Classifier
      </h1>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/controllers/user/index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="/controllers/user/classifiers.php">User Classifiers</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add New Classifier</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-body">
          <form action="/controllers/user/classifiers.php?op=create"
                enctype="multipart/form-data"
                method="POST">
            <div class="form-group row">
              <label for="title" class="col-12 col-form-label col-md-2 font-weight-bold">
                Title
              </label>
              <div class="col-12 col-md-10">
                <input type="text" name="title"
                       class="form-control"
                       id="title" required maxlength="150"
                       value="<?php echo $_SESSION['fields']['title']['data'] ?? ""; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="type" class="col-12 col-form-label col-md-2 font-weight-bold">
                Type
              </label>
              <div class="col-12 col-md-10">
                <select name="type" id="type" class="form-control">
                  <?php foreach ($types as $k => $type) { ?>
                    <option value="<?php echo $type['id']; ?>"
                      <?php echo isset($_SESSION["fields"]) && ($type['id'] == $_SESSION["fields"]["type"]["data"]) ? "selected" : ""; ?>>
                      <?php echo $type['name']; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="model" class="col-12 col-form-label col-md-2 font-weight-bold">
                Model File
              </label>
              <div class="col-12 col-md-10">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" required
                         name="model" id="model">
                  <label class="custom-file-label" for="file">Choose the HDF5 (.hdf5) file...</label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="labels" class="col-12 col-form-label col-md-2 font-weight-bold">
                Labels File
              </label>
              <div class="col-12 col-md-10">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" required
                         name="labels" id="labels">
                  <label class="custom-file-label" for="file">Choose the labels (.txt) file...</label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="description" class="col-12 col-form-label col-md-2 font-weight-bold">
                Description
              </label>
              <div class="col-12 col-md-10">
                  <textarea type="text" name="description"
                            class="form-control"
                            rows="3" id="description"
                            maxlength="1000"><?php echo $_SESSION['fields']['description']['data'] ?? ""; ?></textarea>
              </div>
            </div>
            <div class="text-center">
              <button class="btn btn-success px-4 submit" type="submit">
                Add
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once("common/bottom.view.php"); ?>
