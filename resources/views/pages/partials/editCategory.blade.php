@extends('layouts.app')

@section('tittle','Atualizar Categoria')

@section('content')
    <form id="category" method="post" action="{{route('updateCategory',['categoryShopping'=>$categoryShopping->id])}}">
        @method('PUT')
        @csrf
        <div class="card card-body">
            <h5 class="card-title ">Cadastrar</h5>
            <div class="row">
                <div class="col-4">
                    <x-input name="name" id="name" label="Categoria da compra" required="true"
                             type="text" value="{{$categoryShopping->name}}"/>
                </div>
                <div class="col-2 d-flex" style="align-self: end;">
                    <x-button-submit id="btn-submit" label="Salvar"/>
                </div>
            </div>
        </div>
    </form>
@endsection
