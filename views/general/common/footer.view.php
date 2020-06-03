<?php
if (strcmp(realpath(__FILE__), $_SERVER["SCRIPT_FILENAME"]) == 0) {
  header("Location: /");
  return;
}
?>

<footer>
  <div class="jumbotron jumbotron-fluid my-0 bg-lightcoral text-white">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6">
          <h4>Quick Links</h4>
          <hr>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white">Contact Us</a></li>
            <li><a href="#" class="text-white">FAQ</a></li>
          </ul>
        </div>
        <div class="col-12 col-md-6">
          <h4>Contact Information</h4>
          <hr>
          <ul class="list-unstyled">
            <li>
              <i class="fa fa-phone"></i>
              <?php echo $configsArr['phone']; ?>
            </li>
            <li>
              <i class="fa fa-at"></i>
              <?php echo $configsArr['email']; ?>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>