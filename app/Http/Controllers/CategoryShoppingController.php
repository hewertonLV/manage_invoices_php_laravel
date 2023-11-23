<?php

namespace App\Http\Controllers;

use App\Models\CategoryShopping;
use App\Http\Controllers\Controller;
use App\Models\ShoppingLaunch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class CategoryShoppingController extends Controller
{
    public function __construct(
        protected CategoryShopping $category,
        protected ShoppingLaunch $shoppingLaunch,
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = $this->category->getCategoryByUser();
        return view('pages.category')->with(['categorys' => $categorys ?? []]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request['user_id'] = Auth::user()->id;
            $this->category->fill($request->input());

            if ($this->category->save()) {
                toastr()->success('Categoria adicionada com sucesso.', 'Operação Realizada');
                return redirect()->route('category');
            }
            toastr()->error('Falha ao cadastrar a categoria.', 'Operação Falhou');
            return redirect()->route('category');
        } catch (\Exception $e){
            toastr()->error('Categoria Já cadastrada.', 'Operação Falhou');
            return redirect()->route('category')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryShopping $categoryShopping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryShopping $categoryShopping)
    {
        return view('pages.partials.editCategory')->with(['categoryShopping'=>$categoryShopping]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryShopping $categoryShopping)
    {
        try {
            $categoryShopping->update($request->all());
            toastr()->success('Categoria atualizado.', 'Operação Realizada');
            return redirect()->route('category');
        } catch (\Exception $e) {
            toastr()->error('Error ao atualizar categoria.', 'Operação Falhou');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryShopping $categoryShopping)
    {
        try {
            $launchs = $this->shoppingLaunch->getShoppingLaunchByUser() ?? [];
            foreach ($launchs as $launch) {
                if ($launch->card_id == $categoryShopping->id) {
                    toastr()->error('Existe faturas pendentes para a categoria ' . $categoryShopping->name, 'Operação Falhou');
                    return redirect()->route('category');
                }
            }
            if ($categoryShopping->delete()) {
                toastr()->success('Categoria excluido.', 'Operação realizada');
                return redirect()->route('category');
            } else {
                toastr()->error('Falha ao excluir a categoria.', 'Operação Falhou');
                return redirect()->route('category');
            }

        } catch (\Exception $e) {
            toastr()->error($e, 'Operação Falhou');
            return redirect()->route('category');
        }
    }
}
