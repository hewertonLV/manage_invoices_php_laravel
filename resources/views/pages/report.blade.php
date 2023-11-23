@extends('layouts.app')

@section('tittle','Fatura')

@section('content')
    <div class="card card-body">
        <form id="showInvoice" method="get" action="{{route('showInvoice')}}">
            @csrf
            <h5 class="card-title ">Consultar Fatura</h5>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <x-select id="idBuyer" name="idBuyer" label="Comprador" :dataset="$buyers"
                              />
                </div>
                <div class="col-md-3 col-sm-6">
                    <x-select id="idCard" name="idCard" label="Cartão" :dataset="$cards"
                              />
                </div>
                <div class="col-md-3 col-sm-6">
                    <x-input name="shoppingDate" required="true" id="shoppingDate" label="Mês da fatura"
                             type="Month" value=""/>
                </div>
                <div class="col-2 d-flex" style="align-self: end;">
                    <x-button-submit id="btn-submit" label="Buscar"/>
                </div>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-body"><h5 class="card-title "> Cartões</h5>
                <table class="table text-center basic-datatable table-sm table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Comprador</th>
                        <th>Cartão</th>
                        <th>Categoria</th>
                        <th>Valor Parcela</th>
                        <th>Valor Total</th>
                        <th>Compra</th>
                        <th>Parcelas</th>
                        <th>Descrição</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($launchs['installments'] ?? [] as $launch)
                        <tr>
                            <td>{{$launch->id}}</td>
                            <td>{{$launch->buyer->name}}</td>
                            <td>{{$launch->cards->name}}</td>
                            <td>{{$launch->categoryShopping->name}}</td>
                            <td>{{number_format($launch->installmentNow,2,',','.')}} R$</td>
                            <td>{{number_format($launch->value,2,',','.')}} R$</td>
                            <td>{{$launch->date_shopping}}</td>
                            <td>{{$launch->InvoiceNow}} / {{$launch->installmentsNumber}}</td>
                            <td>{{$launch->description}}</td>
                        </tr>
                    @endforeach
                    @if(isset($launchs))
                        <tr>
                            <td colspan="5"><span>Valor Total da Fatura: </span></td>
                            <td colspan="5"><span>{{number_format($launchs['valueInvoice'],2,',','.')}} R$</span></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
@endsection
