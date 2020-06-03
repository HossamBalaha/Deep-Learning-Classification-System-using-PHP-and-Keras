<?php
if (strcmp(realpath(__FILE__), $_SERVER["SCRIPT_FILENAME"]) == 0) {
  header("Location: /");
  return;
}
?>

<?php include_once("common/top.view.php"); ?>
<?php //include_once("common/navbar.view.php"); ?>
<?php include_once("common/success.view.php"); ?>
<?php include_once("common/errors.view.php"); ?>

<div class="bg-cover"></div>
<div class="container center-middle">
  <div class="row">
    <div class="col-12 col-md-6 offset-0 offset-md-3">
      <div class="card m-auto shadow">
        <div class="card-body">
          <h1 class="text-center m-0 display-7">
            <?php echo $configsArr['name']; ?>
          </h1>
          <h5 class="text-center m-0 mt-2">
            Login
          </h5>
          <hr>
          <form action="/controllers/auth/login.php" method="POST">
            <div class="form-group row">
              <div class="col-12">
                <input type="text" class="form-control text-center"
                       name="username" id="username"
                       required maxlength="150"
                       value="<?php echo $_SESSION['fields']['username']['data'] ?? ""; ?>"
                       placeholder="Enter your Username">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-12">
                <input type="password" class="form-control text-center"
                       name="password" id="password"
                       required maxlength="150"
                       placeholder="Enter your Password">
              </div>
            </div>
            <div class="text-center mt-2">
              <input type="submit" value="Login" class="btn btn-success">
            </div>
          </form>
        </div>
        <div class="card-footer">
          <div class="text-center">
            Don't have an account? <a href="/controllers/auth/register.php">Register</a>
          </div>
          <div class="text-center">
            Return <a href="/">Home</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php //include_once("common/footer.view.php"); ?>
<?php include_once("common/bottom.view.php"); ?>
