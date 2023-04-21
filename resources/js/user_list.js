$(document).on('click', '.toggle-status', function(){
  let url = $(this).data('action');

  $.ajax({
      method: 'POST',
      url: url,
      data: {},
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success:function(data){
          toggleCheckBox(data);
      }
  });
  
});

function toggleCheckBox(data) {
  var mySelector = '#toggle-status-txt-'+data.id;

  var actifChkBox = $('<span id="toggle-status-txt-'+data.id+'" class="font-weight-bolder" style="color: #5cb85c;">ACTIF</span>');
  var inactifChkBox = $('<span id="toggle-status-txt-'+data.id+'" class="font-weight-bolder" style="color: #fe794e";">INACTIF</span>');

  if(data.status == 'Actif')
      $(mySelector).replaceWith(actifChkBox);
  else
      $(mySelector).replaceWith(inactifChkBox);
}
