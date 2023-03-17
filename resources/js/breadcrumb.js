$(document).on('click', '.breadcrumb-button', function(){
  toggleLeftButtonAndBreadcrumb();
});

$(document).on('click', '#right-arrow-button-non-active', function(){
  toggleLeftButtonAndBreadcrumb();
});

function toggleLeftButtonAndBreadcrumb() {
  var userListContainer = $(".user-search-list");
  var leftArrowBtn = $("#left-arrow-button");
  var rightArrowBtn = $("#right-arrow-button");

  rightArrowBtn.toggle();
  leftArrowBtn.toggle();

  var activeLeftBtn = $("#active-left-side-button");
  var nonActiveLeftBtn = $("#non-active-left-side-button");

  nonActiveLeftBtn.toggle();
  activeLeftBtn.toggle();


  if (userListContainer.hasClass("d-none")) {
      userListContainer.toggleClass("d-none");
  } else {
      userListContainer.toggleClass("d-none");
  }
}