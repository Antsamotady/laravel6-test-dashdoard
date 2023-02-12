@extends('layouts.app')

@section('content')
<div class="container">
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
                        <label class="col-form-label" for="inlineFormInputName">Nom : </label>
                        <input type="text" class="form-control mb-2 mr-2 ml-2" id="inlineFormInputName" placeholder="">

                        <label class="col-form-label" for="inlineFormInputGroup">Statut : </label>
                        <div class="input-group mb-2 mr-2 ml-2">
                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Actif">
                            <div class="dropdown">
                                <button class="btn btn-secondary bg-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#" id="Actif">Actif</a>
                                    <a class="dropdown-item" href="#" id="Inactif">Inactif</a>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2" id="rechercher">Rechercher</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Liste des utilisateurs</h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                mail
                            </th>
                            <th>
                                vide
                            </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

<script type="text/javascript">
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
                $('tbody').html(data);
            }

        });
    });


</script>
@endsection
