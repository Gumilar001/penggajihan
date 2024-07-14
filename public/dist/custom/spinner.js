
function showLoading() {
  $("#loading-page").addClass("m-fadeIn").removeClass("m-fadeOut");
  $("body").addClass("overflow-hidden");
}

function hideLoading() {
  $("#loading-page").removeClass("m-fadeIn").addClass("m-fadeOut");
  $("body").removeClass("overflow-hidden");
}