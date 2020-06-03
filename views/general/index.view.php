<?php
if (strcmp(realpath(__FILE__), $_SERVER["SCRIPT_FILENAME"]) == 0) {
  header("Location: /");
  return;
}
?>

<?php include_once("common/top.view.php"); ?>
<?php //include_once("common/navbar.view.php"); ?>


<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <?php foreach ($sliderItems as $k => $sliderItem) { ?>
      <div class="carousel-item <?php echo $k == 0 ? 'active' : '' ?>">
        <img src="<?php echo $sliderItem['image']; ?>" class="d-block w-100 carousel-image" alt="..."
             width="100%" height="600px">
        <div class="carousel-caption bg-lightcoral mb-4 rounded">
          <h1 class="font-weight-bold text-white">
            <?php echo $sliderItem['title']; ?>
          </h1>
          <h4 class="font-weight-bold text-white h5">
            <?php echo $sliderItem['description']; ?>
          </h4>
          <div class="text-center">
            <a href="/controllers/auth/login.php" class="btn btn-light text-center font-weight-bold">
              Login
            </a>
            <br>
            <a href="/controllers/auth/register.php" class="btn btn-sm text-white mt-1 text-center font-weight-bold">
              Register
            </a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container my-5">
  <div class="row">
    <?php foreach ($cardItems as $cardItem) { ?>
      <div class="col-12 mt-3">
        <div class="card shadow shadow-lg border rounded">
          <div class="card-body">
            <div class="media align-items-center">
              <img src="<?php echo $cardItem['image']; ?>"
                   class="shadow shaodw-lg rounded-circle mr-3" width="100" height="100" alt="">
              <div class="media-body">
                <h4 class="text-center mt-1">
                  <?php echo $cardItem['title']; ?>
                </h4>
                <p class="text-center">
                  <?php echo $cardItem['description']; ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<?php include_once("common/footer.view.php"); ?>
<?php include_once("common/bottom.view.php"); ?>

<script>
  $(document).ready(function () {
    var vh = $(window).height();
    $('.carousel-image').attr("height", vh + "px");
  });
</script>
