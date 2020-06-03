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
        User Classifiers
      </h1>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/controllers/user/index.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">User Classifiers</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-body">
          <div class="text-right">
            <a href="/controllers/user/classifiers.php?op=create" class="btn btn-primary btn-sm mb-2">
              Add New Classifier
            </a>
          </div>
          <?php if (isset($userClassifiers) && count($userClassifiers) > 0) { ?>
            <table class="table table-hover table-striped table-bordered mb-0">
              <thead>
              <tr class="text-center">
                <th>#</th>
                <th>Title</th>
                <th>Type</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Operations</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($userClassifiers as $k => $userClassifier) { ?>
                <tr class="text-center">
                  <td class="align-middle"><?php echo $k + 1; ?></td>
                  <td class="align-middle"><?php echo $userClassifier['title'] ?></td>
                  <td class="align-middle"><?php echo $userClassifier['name'] ?></td>
                  <td class="align-middle"><?php echo nl2br($userClassifier['description']) ?></td>
                  <td class="align-middle"><?php echo $userClassifier['created_at'] ?></td>
                  <td class="align-middle">
                    <a class="btn btn-danger btn-sm delete"
                       href="/controllers/user/classifiers.php?op=delete&target=<?php echo $userClassifier['id']; ?>">
                      <i class="fa fa-trash"></i>
                    </a>
                  </td>
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
