@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-4 pl-0 mb-2">
        <button type="submit" 
            class="btn btn-primary col-8 text-light" 
            data-toggle="modal"  
            data-target="#modalID"
            id="addUser">
            Ajouter un utilisateur
            <span class="material-icons md-18">add</span>
        </button>
    </div>

    <div class="modal fade" id="modalID" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mediumBody">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                IMAGE et boutons
                            </div>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="form002">Civilité<span class="material-icons md-14 text-danger">lock</span></label>
                                            <input type="text" class="form-control" id="form002" placeholder="">
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
                                        <h5 class="card-header">Informations de connexion</h5>
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
                            <div class="f-item text-danger"><span class="material-icons md-14">lock</span>Champs obligatoires</div>
                            <div class="f-item">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary" id='add_task_submit'>Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="modal-footer">
                </div> -->
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

                    <form class="form-inline">
                        <div class="col-4">
                            <span class="col-form-label" for="inlineFormInputName">Nom : </span>
                            <input type="text" class="form-control" id="inlineFormInputName" placeholder="">
                        </div>
                        
                        <div class="col-4">
                            <span class="col-form-label" for="inlineFormInputGroup">Statut : </span>
                            <span class="">
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Tous">
                                <span class="dropdown">
                                    <button class="btn btn-secondary bg-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#" id="Tous">Tous</a>
                                        <a class="dropdown-item" href="#" id="Actif">Actif</a>
                                        <a class="dropdown-item" href="#" id="Inactif">Inactif</a>
                                    </div>
                                </span>
                            </span>
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary col-6" id="rechercher">Rechercher</button>
                        </div>
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
    $(document).on('click', '#addUser', function(event) {
        event.preventDefault();
        $('#modalID').fadeIn();
    });



    $(document).on('click', '.dropdown-item', function(){
        var selectedValue = $(this).attr("id");
        var inputF = document.getElementById("inlineFormInputGroup");
        inputF.value = selectedValue;
    });

    $(document).on('click', '#rechercher', function(){
        var name = document.getElementById("inlineFormInputName").value
        var status = document.getElementById("inlineFormInputGroup").value;
        // console.log(name + ' - ' + status);

        $.ajax({
            type : 'get',
            url : '{{URL::to('search')}}',
            data:{'name':name, 'status':status},
            success:function(data){
                $('.user-list').html(data);
            }

        });
    });

    $(document).on('click', '#addUser', function(){
        console.log('wanna Add?');
    });

    $(document).on('click', '#editUser', function(){
        console.log('wanna Edit?');
    });

    $(document).on('click', '#delUser', function(){
        console.log('wanna Delete?');
    });

</script>
@endsection
