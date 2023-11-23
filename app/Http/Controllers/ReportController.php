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

class ReportController extends Controller
{
    public function __construct(
        protected CategoryShopping $category,
        protected Buyer $buyer,
        protected Card $card,
        protected ShoppingLaunch $shoppingLaunch,
    ){}

    public function index()
    {
        $buyer = $this->buyer->getBuyerByUser();
        $card = $this->card->getCardByUser();
       return view('pages.report')->with([
           'buyers'=>$buyer,
           'cards' => $card
       ]);
    }

    public function show(Request $request)
    {
        $request['user_id'] = Auth::user()->id;
        $buyer = $this->buyer->getBuyerByUser();
        $card = $this->card->getCardByUser();

        $idBuyer = $request->idBuyer;
        $idCard = $request->idCard;
        $dateMonth = $request->shoppingDate;

        $interval = [
            Carbon::parse($dateMonth),
            Carbon::parse($dateMonth)->lastOfMonth(),
        ];

        $listLaunchCard = [];
        $listLaunchBuyer = [];
        $launchs = ShoppingLaunch::getLaunchsMonth($interval);

        if ($idBuyer){
            foreach ($launchs['installments'] as $launch){
                if ($launch->buyer_id == $idBuyer){
                    $listLaunchBuyer[] = $launch;
                } else {
                    $launchs['valueInvoice'] -= $launch->value_installments;
                }
            }
            unset($launchs['installments']);
            $launchs['installments'] = $listLaunchBuyer;
            unset($listLaunchBuyer);
        }

        if ($idCard){
            foreach ($launchs['installments'] as $launch){
                if ($launch->card_id == $idCard){
                    $listLaunchCard[] = $launch;
                } else {
                    $launchs['valueInvoice'] -= $launch->value_installments;
                }
            }
            unset($launchs['installments']);
            $launchs['installments'] = $listLaunchCard;
            unset($listLaunchCard);
        }

        return view('pages.report',)->with([
            'launchs' => $launchs,
            'buyers'=>$buyer,
            'cards' => $card
        ]);
    }


}
