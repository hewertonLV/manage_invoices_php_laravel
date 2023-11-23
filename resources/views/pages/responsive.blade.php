@extends('layouts.app')

@section('tittle','Compradores')

@section('content')

    <div class="card card-body">
        <h5 class="card-title ">Cadastrar comprador</h5>
        <form id="addBuyer" method="post" action="{{route('addBuyer')}}">
            @csrf
            <div class="row">
                <div class="col-5">
                    <x-input name="name" id="nameResponsavel" required="true"
                             label="Responsavel"
                             type="text" value=""/>
                </div>
                <div class="col-5">
                    <x-input name="description" id="descricao" required="true" label="Descrição"
                             type="text" value=""/>
                </div>
                <div class="col-2 d-flex" style="align-self: end;">
                    <x-button-submit id="btn-submit" label="Adicionar"/>
                </div>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title ">Responsaveis</h5>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
                </thead>
                <tbody>
                @foreach($buyers as $buyer)
                    <tr>
                        <th>{{$buyer->id}}</th>
                        <td>{{$buyer->name}}</td>
                        <td>{{$buyer->description}}</td>
                        <td>
                            <form method="get" action="{{route('editBuyer',['buyer'=>$buyer->id])}}">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary rounded-pill">Editar</button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="{{route('destroyBuyer',['buyer'=>$buyer->id])}}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-outline-danger rounded-pill">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
