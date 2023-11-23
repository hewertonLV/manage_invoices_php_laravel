<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\ShoppingLaunch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class dashboardController extends Controller
{
    public function __construct(
        protected Buyer          $buyer,
        protected ShoppingLaunch $shoppingLaunch,
        protected Card           $card,
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dateMonth = Carbon::now()->format('Y-m-d');
        $interval = [
            Carbon::parse($dateMonth),
            Carbon::parse($dateMonth)->lastOfMonth(),
        ];

        $buyers = $this->buyer->getBuyerByUser() ?? [];
        $launchs = ShoppingLaunch::getLaunchsMonth($interval);

        $datas = [];
        $cont = 0;
        foreach ($buyers as $buyer) {
            $datas[$cont] = [
                'buyer_id' => $buyer->id,
                'name' => $buyer->name,
                'value' => 0,
            ];
            foreach ($launchs['installments'] as $launch) {
                if ($launch->buyer_id == $buyer->id) {
                    $datas[$cont]['value'] += $launch->value_installments;
                }
            }
            $cont++;
        }
        foreach ($datas as $data) {
            $data_aux['buyer_id'][] = $data['buyer_id'];
            $data_aux['name'][] = $data['name'];
            $data_aux['value'][] = $data['value'];
        }
        return view('dashboard')->with(['data_aux'=>$data_aux]);
    }

}
