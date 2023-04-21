@extends('dashboard.index')

@section('menu-content')
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
                    <div>
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


<script type="text/javascript">
    $(document).on('click', '#search-btn', function(){
        event.preventDefault();
        var name = document.getElementById("inlineFormInputName").value;
        var status = document.getElementById("inlineFormInputGroup").value;

        $.ajax({
            type : 'get',
            url : '{{ URL::to("dashboard/search") }}',
            data:{'name':name, 'status':status},
            success:function(data){
                $('.user-list').html(data);
            }
        });
    });
</script>
@endsection
