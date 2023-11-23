@extends('layouts.app')

@section('tittle','Atualizar Responsavel')

@section('content')

    <div class="card card-body">
        <h5 class="card-title ">Cadastrar comprador</h5>
        <form id="buyer" method="post" action="{{route('updateBuyer',['buyer'=>$buyer])}}">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-5">
                    <x-input name="name" id="nameResponsavel" required="true"
                             label="Responsavel"
                             type="text" value="{{$buyer->name}}"/>
                </div>
                <div class="col-5">
                    <x-input name="description" id="descricao" required="true" label="Descrição"
                             type="text" value="{{$buyer->description}}"/>
                </div>
                <div class="col-2 d-flex" style="align-self: end;">
                    <x-button-submit id="btn-submit" label="Salvar"/>
                </div>
            </div>
        </form>
    </div>

@endsection
