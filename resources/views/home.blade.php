@extends('layouts.app')

@section('content')
<div class="col-10">
    <div class="col-4 pl-0 mb-2">
        <button type="submit" 
            class="btn btn-primary col-8 text-light" 
            data-toggle="modal"  
            data-target="#modalNewUser"
            id="addUser">
            <div class="d-flex align-items-center justify-content-center">
                Ajouter un utilisateur
                <span class="material-icons md-24">add</span>
            </div>
        </button>
    </div>
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            {!! implode('', $errors->all('<div>:message</div>')) !!}
        </div>
    @endif

    <div class="modal modal-user fade" id="modalNewUser" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-secondary d-flex align-items-center"><span class="material-icons md-24">person_add</span>&nbsp;Créer un nouvel utilisateur</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mediumBody">
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" id="new-user-form">
                        @csrf
                        <div class="row">
                            <div class="col-4 d-flex flex-column align-items-center">
                                <img id="avatar-image-form" src="" alt="">
                                <div class="custom-input-file mt-4">
                                    <p>Choisir une photo</p>
                                    <input type="file" id="avatar-input" name="avatar-input">
                                    <input type="hidden" id="avatar-hidden-input" name="avatar-hidden-input">
                                </div>
                                <div class="img-type-note mt-2">
                                    <button type="button" class="btn btn-outline-danger btn-sm text-danger" disabled>NOTE!</button>
                                    <span>Format: .jpg .png .gif</span>
                                </div>
                                <div class="mt-2" id="">
                                    <button class="btn btn-danger" id="del-avatar-btn">Supprimer la photo</button>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="civilite-input">Civilité<span class="material-icons md-14 text-danger">lock</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="civilite-input" placeholder="" name="civilite">
                                                <div class="dropdown input-group-append">
                                                    <button class="btn btn-secondary bg-warning dropdown-toggle border-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item dropdown-item-civilite" href="#" id="Mlle">Mlle</a>
                                                        <a class="dropdown-item dropdown-item-civilite" href="#" id="Me">Me</a>
                                                        <a class="dropdown-item dropdown-item-civilite" href="#" id="Mr">Mr</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="form002">Prénom<span class="material-icons md-14 text-danger">lock</span></label>
                                            <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus id="form002" placeholder="">
                                            @error('surname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="form003">Nom<span class="material-icons md-14 text-danger">lock</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus id="form003" placeholder="">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="card w-75">
                                        <h5 class="card-header">Informations</h5>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="form004">Téléphone<span class="material-icons md-14 text-danger">lock</span></label>
                                                        <input id="form004" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                                        @error('phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="form005">Mobile<span class="material-icons md-14 text-danger">lock</span></label>
                                                        <input id="form005" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">
                                                        @error('mobile')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <div class="card w-90">
                                        <h5 class="card-header"><span class="material-icons md-14 text-secondary">lock</span>Informations de connexion</h5>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="form006">Email<span class="material-icons md-14 text-danger">lock</span></label>
                                                        <input id="form006" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="form007">Mot de passe<span class="material-icons md-14 text-danger">lock</span></label>
                                                        <input id="form007" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="form008">Confirmer mot de passe<span class="material-icons md-14 text-danger">lock</span></label>
                                                        <input id="form008" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-between">
                            <div class="f-item text-danger d-flex align-items-center"><span class="material-icons md-14">lock</span>&nbsp;Champs obligatoires</div>
                            <div class="f-item">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary" id='add_task_submit'>Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="modalEditUser" class="modal modal-user fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-secondary d-flex align-items-center"><span class="material-icons md-24">person_add</span>&nbsp;Modifier les informations de l'utilisateur</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editUserForm">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="row">
                        <div class="col-4 d-flex flex-column align-items-center">
                            <img id="avatar-image-form" src="" alt="">
                            <div class="custom-input-file mt-4">
                                <p>Choisir une photo</p>
                                <input type="file" id="avatar-input">
                            </div>
                            <div class="img-type-note mt-2">
                                <button type="button" class="btn btn-outline-danger btn-sm text-danger" disabled>NOTE!</button>
                                <span>Format: .jpg .png .gif</span>
                            </div>
                            <div class="mt-2" id="">
                                <button class="btn btn-danger" id="del-avatar-btn">Supprimer la photo</button>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="form009">Civilité<span class="material-icons md-14 text-danger">lock</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="form009" placeholder="">
                                            <div class="dropdown input-group-append">
                                                <button class="btn btn-secondary bg-warning dropdown-toggle border-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#" id="Tous">Mlle</a>
                                                    <a class="dropdown-item" href="#" id="Actif">Me</a>
                                                    <a class="dropdown-item" href="#" id="Inactif">Mr</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="form029">Prénom<span class="material-icons md-14 text-danger">lock</span></label>
                                        <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus id="form029" placeholder="">
                                        @error('surname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="form010">Nom<span class="material-icons md-14 text-danger">lock</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus id="form010" placeholder="">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="card w-75">
                                    <h5 class="card-header">Informations</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="form011">Téléphone<span class="material-icons md-14 text-danger">lock</span></label>
                                                    <input id="form011" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                                    @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="form012">Mobile<span class="material-icons md-14 text-danger">lock</span></label>
                                                    <input id="form012" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">
                                                    @error('mobile')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="card w-90">
                                    <h5 class="card-header"><span class="material-icons md-14 text-secondary">lock</span>Informations de connexion</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group" id="parent-reset-password">
                                                    <label for="form013">Email<span class="material-icons md-14 text-danger">lock</span></label>
                                                    <input id="form013" type="email" class="form-control" name="email" value="" required autocomplete="email">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6 changePass" id="{{ $user->id }}">
                                                <button class="btn btn-danger" data-action="{{ route('password.email') }}" id="changePassBtn">Changer de mot de passe</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between">
                        <div class="f-item text-danger d-flex align-items-center"><span class="material-icons md-14">lock</span>&nbsp;Champs obligatoires</div>
                        <div class="f-item">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary" id='add_task_submit2'>Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>

    <div id="modalConfirmDel" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-warning d-flex align-items-center"><span class="material-icons md-24">warning</span>&nbsp;Attention!</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <h4 class="center">Confirmez que vous voulez supprimer l'utilisateur<strong id="currentUser"></strong></h4>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="button" id="click-me" class="btn btn-warning" onclick="validate();">Valider</a>
            </div>
          </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">RECHERCHER</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-inline justify-content-between">
                        
                        <div class="offset-1">
                            <span class="col-form-label" for="inlineFormInputName">Nom : </span>
                            <input type="text" class="form-control" id="inlineFormInputName" placeholder="">
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <span class="col-form-label" for="inlineFormInputGroup">Statut :&nbsp;</span>
                            <div class="input-group">
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Tous">
                                <span class="dropdown input-group-append">
                                    <button class="btn btn-secondary bg-warning dropdown-toggle border-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item dropdown-item-status" href="#" id="Tous">Tous</a>
                                        <a class="dropdown-item dropdown-item-status" href="#" id="Actif">Actif</a>
                                        <a class="dropdown-item dropdown-item-status" href="#" id="Inactif">Inactif</a>
                                    </div>
                                </span>
                            </div>
                        </div>

                        
                        <button type="submit" class="btn btn-primary" id="search-btn">Rechercher</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-2 row justify-content-center">
        <div class="col-md-12 user-list"></div>
    </div>
</div>

                

<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

<script type="text/javascript">
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

    $('.dropdown-item-status').click(function(event) {
        let clickedItemValue = $(event.target).text();
        $('#inlineFormInputGroup').val(clickedItemValue);
    });

    $(document).on('click', '#search-btn', function(){
        event.preventDefault();
        var name = document.getElementById("inlineFormInputName").value;
        var status = document.getElementById("inlineFormInputGroup").value;

        $.ajax({
            type : 'get',
            url : '{{URL::to('search')}}',
            data:{'name':name, 'status':status},
            success:function(data){
                $('.user-list').html(data);
            }

        });
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
        var name = $(this).attr('nom');
        var surname = $(this).attr('surname');
        var phone = $(this).attr('phone');
        var mobile = $(this).attr('mobile');
        var email = $(this).attr('email');

        var inputName = document.getElementById("form010");
        var inputSurname = document.getElementById("form029");
        var inputPhone = document.getElementById("form011");
        var inputMobile = document.getElementById("form012");
        var inputMail = document.getElementById("form013");

        inputName.value = name;
        inputSurname.value = surname;
        inputPhone.value = phone;
        inputMobile.value = mobile;
        inputMail.value = email;

        if ($('.changePass').attr('id') == id)
            $('.changePass').addClass('d-none');

        urlEdit = "{{ route('user.update', '------')}}";
        urlEdit = urlEdit.replace("------", id);

        form = document.querySelectorAll('#editUserForm');
        form[0].setAttribute('action', urlEdit);
    });

    $(document).on('click', '.delUser', function(){
        event.preventDefault();
        var id = $(this).attr('id');

        urlDelete = "{{ route('user.destroy', '------')}}";
        urlDelete = urlDelete.replace("------", id);

    });

    $(document).on('click', '#del-avatar-btn', function(){
        event.preventDefault();
        removeAvatar();
    });

    $(document).on('change', '#avatar-input', function(){
        changeAvatar();
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
        var url = '/home/toggle/'+ data.id;
        var currentId = 'toggle-status-btn-'+ data.id +'-'+ data.status;
        var mySelector = '#'+ currentId;

        console.log(currentId);

        var actifChkBox = $('<button id="'+currentId+'" type="button" class="btn btn-success toggle-status" data-action="'+url+'">ACTIF</button>');
        var inactifChkBox = $('<button id="'+currentId+'" type="button" class="btn btn-warning toggle-status" data-action="'+url+'">INACTIF</button>');

        if(data.status == 'Actif')
            $(mySelector).replaceWith(inactifChkBox);
        else
            $(mySelector).replaceWith(actifChkBox);
    }

    function validate() {
        window.location = urlDelete;
    }

    function removeAvatar() {
          var image = document.getElementById("avatar-image-form");
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

</script>
@endsection
