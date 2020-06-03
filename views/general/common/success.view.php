<?php
if (strcmp(realpath(__FILE__), $_SERVER["SCRIPT_FILENAME"]) == 0) {
  header("Location: /");
  return;
}
?>

<?php if (isset($_SESSION['success']) && strlen($_SESSION['success'])) { ?>
  <div class="alert alert-success alert-dismissible fade show mb-0"
       role="alert" style="top:2%; right:1%; position: absolute; z-index: 999;">
    <button type="button" class="close"
            data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <div>
      <p class="m-0">
        <?php echo $_SESSION['success']; ?>
      </p>
    </div>
  </div>
  <?php unset($_SESSION['success']); ?>
<?php } ?>