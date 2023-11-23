<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Card;
use App\Models\CategoryShopping;
use App\Models\ShoppingLaunch;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingLaunchController extends Controller
{
    public function __construct(
        protected ShoppingLaunch $shoppingLaunch,
        protected Buyer $buyer,
        protected Card $card,
        protected CategoryShopping $categoryShopping,
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyers = $this->buyer->getBuyerByUser();
        $cards = $this->card->getCardByUser();
        $category = $this->categoryShopping->getCategoryByUser();
        $launchs = $this->shoppingLaunch->getShoppingLaunchByUser();
        return view('pages.launch')->with([
            'category' => $category ?? [],
            'buyers' => $buyers ?? [],
            'cards' => $cards ?? [],
            'launchs' => $launchs ?? []
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
            $request['value'] = number_format($request->value, 2, '.', '');
            $date_shopping = $request->date_shopping;
            $data = ShoppingLaunch::getDatesFirstAndLastPaymentByCard($date_shopping, $request->card_id, $request->installmentsNumber);
            $request['date_first_installment'] = $data['date_first_installment'];
            $request['date_last_installment'] = $data['date_last_installment'];

            $values = $this->calcularInstallments($request->value, $request->installmentsNumber);
            $request['value_installments'] = str_replace(',', '', $values['value_installments']);
            $request['first_value_installment'] = str_replace(',', '', $values['first_value_installment']);

            $this->shoppingLaunch->fill($request->input());
            if ($this->shoppingLaunch->save()) {
                toastr()->success('Compra cadastrada.', 'Operação Realizada');
                return redirect()->route('launch');
            }
            toastr()->error('Falha ao cadastrar compra.', 'Operação Falhou');
            return redirect()->route('launch');
        } catch (\Exception $e) {
            toastr()->error($e, 'Operação Falhou');
            return redirect()->route('launch')->withInput();
        }
    }

    function calcularInstallments($valorTotal, $divisor)
    {
        $real = explode('.', $valorTotal)[0];
        $centavos = explode('.', $valorTotal)[1];
        $installment_real = intval($real / $divisor);
        $sobra = $real - ($divisor * $installment_real);
        $installment_centavos = intval((($sobra * 100) + $centavos) / $divisor);
        $valueInstallments = floatval($installment_real . '.' . $installment_centavos);
        $valueFiristInstallment = $valorTotal - ($valueInstallments * $divisor) + $valueInstallments;
        $values['value_installments'] = number_format($valueInstallments, 2);
        $values['first_value_installment'] = number_format($valueFiristInstallment, 2);
        return $values;
    }

    /**
     * Display the specified resource.
     */
    public function show(ShoppingLaunch $shoppingLaunch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShoppingLaunch $shoppingLaunch)
    {
        $buyers = $this->buyer->getBuyerByUser();
        $cards = $this->card->getCardByUser();
        $category = $this->categoryShopping->getCategoryByUser();
        $launchs = $this->shoppingLaunch->getShoppingLaunchByUser();
        return view('pages.partials.editLaunch')->with([
            'category' => $category ?? [],
            'buyers' => $buyers ?? [],
            'cards' => $cards ?? [],
            'launchs' => $launchs ?? [],
            'shoppingLaunch'=>$shoppingLaunch
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShoppingLaunch $shoppingLaunch)
    {
        try {
            $request['user_id'] = Auth::user()->id;
            $request['value'] = number_format($request->value, 2, '.', '');
            $date_shopping = $request->date_shopping;
            $data = ShoppingLaunch::getDatesFirstAndLastPaymentByCard($date_shopping, $request->card_id, $request->installmentsNumber);
            $request['date_first_installment'] = $data['date_first_installment'];
            $request['date_last_installment'] = $data['date_last_installment'];

            $values = $this->calcularInstallments($request->value, $request->installmentsNumber);
            $request['value_installments'] = str_replace(',', '', $values['value_installments']);
            $request['first_value_installment'] = str_replace(',', '', $values['first_value_installment']);

            $this->shoppingLaunch->fill($request->input());
            $shoppingLaunch->update($request->all());
            toastr()->success('Lançamento atualizado.', 'Operação Realizada');
            return redirect()->route('launch');
        } catch (\Exception $e) {
            toastr()->error('Error ao atualizar Lançamento.', 'Operação Falhou');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShoppingLaunch $shoppingLaunch)
    {
        try {
            if ($shoppingLaunch->delete()) {
                toastr()->success('Lançamento Excluido.', 'Operação realizada');
                return redirect()->route('launch');
            } else {
                toastr()->error('Falha ao excluir o lançamento.', 'Operação Falhou');
                return redirect()->route('launch');
            }

        } catch (\Exception $e) {
            toastr()->error($e, 'Operação Falhou');
            return redirect()->route('launch');
        }
    }
}
