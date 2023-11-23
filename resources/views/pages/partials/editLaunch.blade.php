@extends('layouts.app')

@section('tittle','Atualizar Lançamento')

@section('content')

    <div class="card card-body">
        <h5 class="card-title ">Lançar Compras</h5>
        <form id="launch" method="post" action="{{route('updateLaunch',['shoppingLaunch'=>$shoppingLaunch->id])}}">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <x-select id="idBuyer" name="buyer_id" label="Comprador" :dataset="$buyers ?? []"
                              selected="{{$shoppingLaunch->buyer_id}}" required="true"/>
                </div>
                <div class="col-md-3 col-sm-6">
                    <x-select id="idCard" name="card_id" label="Cartão"  :dataset="$cards ?? []"
                              selected="{{$shoppingLaunch->card_id}}" required="true"/>

                </div>
                <div class="col-md-3 col-sm-6">
                    <x-input name="value" id="value"  required="true" label="Valor"
                             type="number" value="{{$shoppingLaunch->value}}"/>
                </div>
                <div class="col-md-3 col-sm-6">
                    <x-select id="idCategory" name="category_id" label="Categoria"  :dataset="$category ?? []"
                              selected="{{$shoppingLaunch->categoryShopping}}" required="true"/>
                </div>
                <div class="col-md-3 col-sm-6">
                    <x-input name="date_shopping"  required="true" id="shoppingDate" label="Data da compra"
                             type="date" value="{{($shoppingLaunch->date_shopping)}}"/>
                </div>

                <div class="col-md-2 col-sm-6">
                    <x-input name="installmentsNumber"  required="true" id="installmentsNumber" label="Parcelas"
                             type="number" value="{{$shoppingLaunch->installmentsNumber}}"/>
                </div>
                <div class="col-md-5 col-sm-8">
                    <x-input name="description"  required="true" id="description" label="Detalhe da compra"
                             type="text" value="{{$shoppingLaunch->description}}"/>
                </div>
                <div class="col-md-2  d-flex" style="align-self: end;">
                    <x-button-submit id="btn-submit" label="Salvar"/>
                </div>
            </div>
        </form>
    </div>

@endsection
