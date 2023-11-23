<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\ShoppingLaunch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class BuyerController extends Controller
{
    public function __construct(
        protected Buyer $buyer,
        protected ShoppingLaunch $shoppingLaunch,
        protected Card $card,
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyers = $this->buyer->getBuyerByUser() ?? [];
        return view('pages.responsive')->with(['buyers' => $buyers ?? []]);
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
            $this->buyer->fill($request->input());
            if ($this->buyer->save()) {
                toastr()->success('Responsavel adicionada com sucesso.', 'Operação Realizada');
                return redirect()->route('responsive');
            }
            toastr()->error('Falha ao cadastrar o responsavel.', 'Operação Falhou');
            return redirect()->route('responsive');
        } catch (\Exception $e) {
            toastr()->error('Responsavel já cadastrado.', 'Operação Falhou');
            return redirect()->route('responsive')->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Buyer $buyer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buyer $buyer)
    {
        return view('pages.partials.editResponsive')->with(['buyer'=>$buyer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buyer $buyer)
    {
        try {
            $buyer->update($request->all());
            toastr()->success('Responsavel atualizado.', 'Operação Realizada');
            return redirect()->route('responsive');
        } catch (\Exception $e) {
            toastr()->error('Error ao atualizar responsvale.', 'Operação Falhou');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buyer $buyer)
    {
        try {
            $cards = $this->card->getCardByUser() ?? [];
            $launchs = $this->shoppingLaunch->getShoppingLaunchByUser() ?? [];
            foreach ($launchs as $launch) {
                if ($launch->buyer_id == $buyer->id) {
                    toastr()->error('Existe faturas pendentes para ' . $buyer->name, 'Operação Falhou');
                    return redirect()->route('responsive');
                }
            }
            foreach ($cards as $card) {
                if ($card->buyer_id == $buyer->id) {
                    toastr()->error('Existe cartões vinculados para ' . $buyer->name, 'Operação Falhou');
                    return redirect()->route('responsive');
                }
            }
            if ($buyer->delete()) {
                toastr()->success('Responsavel excluido.', 'Operação realizada');
                return redirect()->route('responsive');
            } else {
                toastr()->error('Falha ao excluir responsavel.', 'Operação Falhou');
                return redirect()->route('responsive');
            }

        } catch (\Exception $e) {
            toastr()->error($e, 'Operação Falhou');
            return redirect()->route('responsive');
        }
    }
}
