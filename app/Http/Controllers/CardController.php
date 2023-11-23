<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Card;
use App\Http\Controllers\Controller;
use App\Models\ShoppingLaunch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    public function __construct(
        protected Card           $card,
        protected Buyer          $buyer,
        protected ShoppingLaunch $shoppingLaunch,
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyers = $this->buyer->getBuyerByUser() ?? [];
        $cards = $this->card->getCardByUser() ?? [];
        return view('pages.cards')->with([
            'cards' => $cards,
            'buyers' => $buyers,
        ]);
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
            $this->card->fill($request->input());
            if ($this->card->save()) {
                toastr()->success('Cartão adicionado com sucesso.', 'Operação Realizada');
                return redirect()->route('cards');
            }
            toastr()->error('Falha ao cadastrar o cartão.', 'Operação Falhou');
            return redirect()->route('cards');
        } catch (\Exception $e) {
            toastr()->error('Cartão já cadastrado.', 'Operação Falhou');
            return redirect()->route('cards')->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        $buyers = $this->buyer->getBuyerByUser() ?? [];
        return view('pages.partials.editCard')->with([
            'card' => $card,
            'buyers' => $buyers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        try {
            $card->update($request->all());
            toastr()->success('Cartão atualizado.', 'Operação Realizada');
            return redirect()->route('cards');
        } catch (\Exception $e) {
            toastr()->error('Error ao atualizar cartão.', 'Operação Falhou');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        try {
            $launchs = $this->shoppingLaunch->getShoppingLaunchByUser() ?? [];
            foreach ($launchs as $launch) {
                if ($launch->card_id == $card->id) {
                    toastr()->error('Existe faturas pendentes para o cartão ' . $card->name, 'Operação Falhou');
                    return redirect()->route('cards');
                }
            }
            if ($card->delete()) {
                toastr()->success('Cartão excluido.', 'Operação realizada');
                return redirect()->route('cards');
            } else {
                toastr()->error('Falha ao excluir o cartão.', 'Operação Falhou');
                return redirect()->route('cards');
            }

        } catch (\Exception $e) {
            toastr()->error($e, 'Operação Falhou');
            return redirect()->route('cards');
        }
    }
}
