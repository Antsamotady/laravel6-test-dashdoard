$(document).on('click', '.dropdown-item-status', function(event) {
    let clickedItemValue = $(event.target).text();
    $('#inlineFormInputGroup').val(clickedItemValue);
});
