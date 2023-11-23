@extends('layouts.app')

@section('tittle','Atualizar Cartão')

@section('content')
    <form method="post" action="{{route('updateCard',['card'=>$card->id])}}">
        @method('PUT')
        @csrf
        <div class="card card-body">
            <div class="row">
                <div class="col-3">
                    <x-input name="name" id="nameCard" label="Nome" required="true"
                             type="text" value="{{$card->name}}"/>
                </div>
                <div class="col-2">
                    <x-input name="day_expiration" required="true" id="vencimento" label="Dia/vencimento"
                             type="number" value="{{$card->day_expiration}}"/>
                </div>
                <div class="col-2">
                    <x-input name="amount_limit" id="limitCard" label="Limite total" required="true"
                             type="number" value="{{$card->amount_limit}}"/>
                </div>
                <div class="col-md-3 col-sm-6">
                    <x-select id="idBuyer" name="buyer_id" label="Titular" :dataset="$buyers ?? []"
                              selected="{{$card->buyer_id}}" required="true"/>
                </div>
                <div class="col-2 d-flex" style="align-self: end;">
                    <x-button-submit id="btn-submit" label="Salvar"/>
                </div>
            </div>
        </div>
    </form>
@endsection
