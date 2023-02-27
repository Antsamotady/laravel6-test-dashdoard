$(document).on('click', '.left-side-button', function(){
  var userListContainer = $(".user-search-list");
  var userStatContainer = $(".user-stat-cards");

  var activeLeftBtn = $("#active-left-side-button");
  var nonActiveLeftBtn = $("#non-active-left-side-button");

  nonActiveLeftBtn.toggle();
  activeLeftBtn.toggle();

  var activeLeftBtn2 = $("#active-left-side-button2");
  var nonActiveLeftBtn2 = $("#non-active-left-side-button2");

  nonActiveLeftBtn2.toggle();
  activeLeftBtn2.toggle();


  var leftArrowBtn = $("#left-arrow-button");
  var rightArrowBtn = $("#right-arrow-button");

  rightArrowBtn.toggle();
  leftArrowBtn.toggle();
  
  if (userListContainer.hasClass("d-none")) {
      userListContainer.toggleClass("d-none");
  } else {
      userListContainer.toggleClass("d-none");
  }

  if (userStatContainer.hasClass("d-none")) {
      userStatContainer.toggleClass("d-none");
  } else {
      userStatContainer.toggleClass("d-none");
  }

});
