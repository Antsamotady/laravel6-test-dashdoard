$(document).on('click', '.left-side-button', function(){
  var userListContainer = $(".user-search-list");
  var activeLeftBtn = $("#active-left-side-button");
  var nonActiveLeftBtn = $("#non-active-left-side-button");

  nonActiveLeftBtn.toggle();
  activeLeftBtn.toggle();

  var leftArrowBtn = $("#left-arrow-button");
  var rightArrowBtn = $("#right-arrow-button");

  rightArrowBtn.toggle();
  leftArrowBtn.toggle();
  

  if (userListContainer.hasClass("d-none")) {
      userListContainer.toggleClass("d-none");
  } else {
      userListContainer.toggleClass("d-none");
  }
});
