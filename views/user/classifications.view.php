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
        User Classifications
      </h1>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/controllers/user/index.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">User Classifications</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-body">
          <div class="text-right">
            <a href="/controllers/user/classifications.php?op=create" class="btn btn-primary btn-sm mb-2">
              Add New Classification
            </a>
          </div>
          <?php if (isset($userClassifications) && count($userClassifications) > 0) { ?>
            <table class="table table-hover table-striped table-bordered mb-0">
              <thead>
              <tr class="text-center">
                <th>#</th>
                <th>Classifier Title</th>
                <th>Original File Name</th>
                <th>Output</th>
                <th>Created At</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($userClassifications as $k => $userClassification) { ?>
                <tr class="text-center">
                  <td class="align-middle"><?php echo $k + 1; ?></td>
                  <td class="align-middle"><?php echo $userClassification['title']; ?></td>
                  <td class="align-middle"><?php echo htmlspecialchars($userClassification['original_name']); ?></td>
                  <td class="align-middle"><?php echo nl2br($userClassification['output']); ?></td>
                  <td class="align-middle"><?php echo $userClassification['created_at']; ?></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          <?php } else { ?>
            <div class="alert alert-warning mb-0">
              <p class="text-center m-0">
                You don't have any items in the current table.
              </p>
            </div>
          <?php } ?>

        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once("common/bottom.view.php"); ?>
