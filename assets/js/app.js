$(document).ready(function () {
  $(".delete").click(function (ev) {
    var isConfirm = confirm("Are your sure?");
    if (!isConfirm) {
      ev.preventDefault();
    }
  });

  $("input[type='file']").change(function (e) {
    var file = $(this)[0].files[0].name;
    $("#" + $(this).attr("id") + " + label").text("You selected " + file);
  });

  $("form").submit(function (ev) {
    $(".submit").attr("disabled", "disabled").addClass("disabled")
      .html("Please Wait <i class='fa fa-spin fa-spinner'></i>");
  });
});