@extends('layouts.app')

@section('tittle','Categorias de Compras')

@section('content')
    <form id="newCategory" method="post" action="{{route('addCategory')}}">
        @csrf
        <div class="card card-body">
            <h5 class="card-title ">Cadastrar</h5>
                <div class="row">
                    <div class="col-4">
                        <x-input name="name" id="name" label="Categoria da compra" required="true"
                                 type="text" value=""/>
                    </div>
                    <div class="col-2 d-flex" style="align-self: end;">
                        <x-button-submit id="btn-submit" label="Adicionar"/>
                    </div>
                </div>
        </div>
    </form>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title "> Categorias cadastradas</h5>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Deletar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categorys as $category)
                <tr>
                    <th>{{$category->id}}</th>
                    <td>{{$category->name}}</td>
                    <td>
                        <form method="get" action="{{route('editCategory',['categoryShopping'=>$category->id])}}">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary rounded-pill">Editar</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{route('destroyCategory',['categoryShopping'=>$category->id])}}">
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
