@extends('layouts.app')

@section('tittle','Compras')

@section('content')

    <div class="card card-body">
        <h5 class="card-title ">Lançar Compras</h5>
        <form id="addLaunch" method="post" action="{{route('addLaunch')}}">
            @csrf
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <x-select id="idBuyer" name="buyer_id" label="Comprador" :dataset="$buyers ?? []"
                              required="true"/>
                </div>
                <div class="col-md-3 col-sm-6">
                    <x-select id="idCard" name="card_id" label="Cartão"  :dataset="$cards ?? []"
                              required="true"/>

                </div>
                <div class="col-md-3 col-sm-6">
                    <x-input name="value" id="value"  required="true" label="Valor"
                             type="number" value=""/>
                </div>
                <div class="col-md-3 col-sm-6">
                    <x-select id="idCategory" name="category_id" label="Categoria"  :dataset="$category"
                              required="true"/>
                </div>
                <div class="col-md-3 col-sm-6">
                    <x-input name="date_shopping"  required="true" id="shoppingDate" label="Data da compra"
                             type="date" value=""/>
                </div>

                <div class="col-md-2 col-sm-6">
                    <x-input name="installmentsNumber"  required="true" id="installmentsNumber" label="Parcelas"
                             type="number" value=""/>
                </div>
                <div class="col-md-5 col-sm-8">
                    <x-input name="description"  required="true" id="description" label="Detalhe da compra"
                             type="text" value=""/>
                </div>
                <div class="col-md-2  d-flex" style="align-self: end;">
                    <x-button-submit id="btn-submit" label="Adicionar"/>
                </div>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title ">Lançamentos</h5>

            <table class="table table-striped">
                <thead>

                <tr>
                    <th>#</th>
                    <th>Cartão</th>
                    <th>Titular</th>
                    <th>Valor</th>
                    <th>Parcelas</th>
                    <th>Data da compra</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
                </thead>
                <tbody>
                @foreach($launchs as $launch)
                <tr>
                    <th>{{$launch->id}}</th>
                    <td>{{$launch->Cards->name}}</td>
                    <td>{{$launch->Buyer->name}}</td>
                    <td>{{$launch->value}} R$</td>
                    <td>{{$launch->installmentsNumber}}</td>
                    <td>{{$launch->date_shopping}}</td>
                    <td>{{$launch->description}}</td>
                    <td>{{$launch->categoryShopping->name}}</td>
                    <td>
                        <form method="get" action="{{route('editLaunch',['shoppingLaunch'=>$launch->id])}}">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary rounded-pill">Editar</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{route('destroyLaunch',['shoppingLaunch'=>$launch->id])}}">
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
