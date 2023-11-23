@extends('layouts.app')

@section('tittle','Cartões')

@section('content')
    <form id="newCard" method="post" action="{{route('addCard')}}">
        @csrf
        <div class="card card-body">
            <h5 class="card-title ">Cadastrar cartão</h5>
            <div class="row">
                <div class="col-3">
                    <x-input name="name" id="nameCard" label="Nome" required="true"
                             type="text" value=""/>
                </div>
                <div class="col-2">
                    <x-input name="day_expiration" required="true" id="vencimento" label="Dia/vencimento"
                             type="number" value=""/>
                </div>
                <div class="col-2">
                    <x-input name="amount_limit" id="limitCard" label="Limite total" required="true"
                             type="number" value=""/>
                </div>
                <div class="col-md-3 col-sm-6">
                    <x-select id="idBuyer" name="buyer_id" label="Titular" :dataset="$buyers ?? []"
                              required="true"/>
                </div>
                <div class="col-2 d-flex" style="align-self: end;">
                    <x-button-submit id="btn-submit" label="Adicionar"/>
                </div>
            </div>
        </div>
    </form>
    <div class="card">
        <div class="card-body"><h5 class="card-title "> Cartões</h5>

            <table class="table basic-datatable text-center table-sm table-striped dt-responsive nowrap w-100">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cartão</th>
                    <th scope="col">Titular</th>
                    <th scope="col">Limite</th>
                    <th scope="col">Vencimento do Cartão</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Excluir</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cards as $card)
                    <tr>
                        <td>{{$card->id}}</td>
                        <td>{{$card->name}}</td>
                        <td>{{$card->buyer->name}}</td>
                        <td>{{number_format($card->amount_limit,2,',','.')}} R$</td>
                        <td>{{$card->day_expiration}}</td>
                        <td>
                            <form method="get" action="{{route('editCard',['card'=>$card->id])}}">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary rounded-pill">Editar</button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="{{route('destroyCard',['card'=>$card->id])}}">
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
