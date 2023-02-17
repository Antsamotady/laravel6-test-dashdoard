var urlEdit = "";
var urlDelete = "";

$(document).on('click', '#addUser', function(event) {
    event.preventDefault();
    $('#modalNewUser').fadeIn();
});

$('.dropdown-item-civilite').click(function(event) {
    let clickedItemValue = $(event.target).text();
    $('#civilite-input').val(clickedItemValue);
});

$('.dropdown-item-edit-civilite').click(function(event) {
    let clickedItemValue = $(event.target).text();
    $('#edit-civilite-input').val(clickedItemValue);
});

$('.dropdown-item-status').click(function(event) {
    let clickedItemValue = $(event.target).text();
    $('#inlineFormInputGroup').val(clickedItemValue);
});

$(document).on('click', '#changePassBtn', function(){
    event.preventDefault();
    var email = document.getElementById("form013").value;
    let url = $(this).data('action');
    
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    })

    $.ajax({
        type : 'post',
        url : url,
        data:{'email':email},
        success:function(data, textStatus, xhr){
            if(xhr.status == 200) {
                $('#form013').addClass('is-valid');
                $('#parent-reset-password').append('<div class="valid-feedback">Email bien envoyer</div>')
            } else {
                $('#form013').addClass('is-invalid');
                $('#parent-reset-password').append('<div class="invalid-feedback">Email non envoyé, veuillez vérifier.</div>')

            }

        }

    });
});

$(document).on('click', '.editUser', function(){
    event.preventDefault();
    var id = $(this).attr('id');
    var civilite = $(this).attr('civilite');
    var image = $(this).attr('avatar');
    var name = $(this).attr('nom');
    var surname = $(this).attr('surname');
    var phone = $(this).attr('phone');
    var mobile = $(this).attr('mobile');
    var email = $(this).attr('email');

    var inputName = document.getElementById("form010");
    var inputCivilite = document.getElementById("edit-civilite-input");
    var inputSurname = document.getElementById("form029");
    var inputPhone = document.getElementById("form011");
    var inputMobile = document.getElementById("form012");
    var inputMail = document.getElementById("form013");
    var inputImage = document.getElementById("avatar-hidden-edit-input");

    inputName.value = name;
    inputCivilite.value = civilite;
    inputSurname.value = surname;
    inputPhone.value = phone;
    inputMobile.value = mobile;
    inputMail.value = email;
    inputImage.value = image;

    urlImg = 'images/'+ image;
    imgTag = document.querySelectorAll('#avatar-image-edit-form');
    imgTag[0].setAttribute('src', urlImg);

    urlEdit = '/home/update/'+id;

    form = document.querySelectorAll('#editUserForm');
    form[0].setAttribute('action', urlEdit);
    console.log($('.changePass').attr('id')+'--'+id);

    if ($('.changePass').attr('id') == id)
        $('.changePass').addClass('d-none');
    else
        $('.changePass').removeClass('d-none');

});

$(document).on('click', '.delUser', function(event){
    event.preventDefault();
    var id = $(this).attr('id');

    urlDelete = '/home/delete/'+id;
});

$(document).on('click', '#del-avatar-btn', function(){
    event.preventDefault();
    removeAvatar();
});

$(document).on('change', '#avatar-input', function(){
    changeAvatar();
});

$(document).on('change', '#avatar-edit-input', function(){
    editAvatar();
});

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

$(document).on('click', '#confirm-user-deletion', function(){
    window.location = urlDelete;
});

function removeAvatar() {
      var image = document.getElementById("avatar-image-form");
      image.src = "";
      var image = document.getElementById("avatar-image-edit-form");
      image.src = "";
}

function changeAvatar() {
    var input = document.getElementById("avatar-input");
    var file = input.files[0];

    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function() {
      var image = document.getElementById("avatar-image-form");
      image.src = reader.result;
      $('#avatar-hidden-input').attr('value', file.name);
    };
}

function editAvatar() {
    var input = document.getElementById("avatar-edit-input");
    var file = input.files[0];

    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function() {
      var image = document.getElementById("avatar-image-edit-form");
      image.src = reader.result;
      $('#avatar-hidden-edit-input').attr('value', file.name);
    };
}
