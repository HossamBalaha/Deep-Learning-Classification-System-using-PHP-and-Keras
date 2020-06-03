<?php
if (strcmp(realpath(__FILE__), $_SERVER["SCRIPT_FILENAME"]) == 0) {
  header("Location: /");
  return;
}
?>

<?php include_once("common/top.view.php"); ?>
<?php //include_once("common/navbar.view.php"); ?>
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
            Register
          </h5>
          <hr>
          <form action="/controllers/auth/register.php" method="POST">
            <div class="form-group row">
              <div class="col-12 col-md-6">
                <input type="text" class="form-control text-center"
                       name="firstName" id="firstName"
                       required maxlength="75"
                       value="<?php echo $_SESSION['fields']['firstName']['data'] ?? ""; ?>"
                       placeholder="First Name">
              </div>
              <div class="col-12 col-md-6 mt-3 mt-md-0">
                <input type="text" class="form-control text-center"
                       name="lastName" id="lastName"
                       maxlength="75"
                       value="<?php echo $_SESSION['fields']['lastName']['data'] ?? ""; ?>"
                       placeholder="Last Name">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-12">
                <input type="text" class="form-control text-center"
                       name="username" id="username"
                       required maxlength="150"
                       value="<?php echo $_SESSION['fields']['username']['data'] ?? ""; ?>"
                       placeholder="Username">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-12">
                <input type="email" class="form-control text-center"
                       name="email" id="email"
                       required maxlength="150"
                       value="<?php echo $_SESSION['fields']['email']['data'] ?? ""; ?>"
                       placeholder="Email">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-12 col-md-6">
                <input type="password" class="form-control text-center"
                       name="password" id="password"
                       required maxlength="150"
                       value=""
                       placeholder="Password">
              </div>
              <div class="col-12 col-md-6 mt-3 mt-md-0">
                <input type="password" class="form-control text-center"
                       name="rePassword" id="rePassword"
                       required maxlength="150"
                       value=""
                       placeholder="Retype Password">
              </div>
            </div>
            <div class="text-center mt-2">
              <input type="submit" value="Register" class="btn btn-success">
            </div>
          </form>
        </div>
        <div class="card-footer">
          <div class="text-center">
            Having an account? <a href="/controllers/auth/login.php">Login</a>
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
