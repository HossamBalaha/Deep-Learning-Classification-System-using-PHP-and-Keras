<?php
if (strcmp(realpath(__FILE__), $_SERVER["SCRIPT_FILENAME"]) == 0) {
  header("Location: /");
  return;
}
?>

<?php if (isset($_SESSION['errors']) && count($_SESSION['errors'])) { ?>
  <div class="alert alert-danger alert-dismissible fade show mb-0"
       role="alert" style="top:2%; right:1%; position: absolute; z-index: 999;">
    <button type="button" class="close"
            data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <div>
      <ul class="list-unstyled m-0">
        <?php foreach ($_SESSION['errors'] as $error) { ?>
          <li>
            <i class="fa fa-caret-right"></i>
            <?php echo $error; ?>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <?php unset($_SESSION['errors']); ?>
<?php } ?>