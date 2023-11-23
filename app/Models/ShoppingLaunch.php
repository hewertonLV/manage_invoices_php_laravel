<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ShoppingLaunch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'buyer_id',
        'card_id',
        'category_id',
        'date_shopping',
        'installmentsNumber',
        'date_first_installment',
        'date_last_installment',
        'value',
        'first_value_installment',
        'value_installments',
        'description'
    ];
    protected $table = 'shopping_launches';

    public function inputs($shopping_launch)
    {
        return [
            'user_id'  => $shopping_launch->user_id,
            'buyer_id' => $shopping_launch->buyer_id,
            'card_id' => $shopping_launch->card_id,
            'category_id' => $shopping_launch->category_id,
            'date_shopping' => $shopping_launch->date_shopping,
            'installmentsNumber' => $shopping_launch->installmentsNumber,
            'date_first_installment' => $shopping_launch->date_first_installment,
            'date_last_installment' => $shopping_launch->date_last_installment,
            'value' => $shopping_launch->value,
            'first_value_installment' => $shopping_launch->first_value_installment,
            'value_installments' => $shopping_launch->value_installments,
            'description' => $shopping_launch->description
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => 'Id do Usuario',
            'buyer_id' => 'Id do comprador',
            'card_id' => 'Id do cartão',
            'category_id' => 'Id da categoria',
            'date_shopping' => 'Data da compra',
            'installmentsNumber' => 'Quantidade de Parcelas',
            'date_first_installment' => 'Mês de inicio da primeira parcela',
            'date_last_installment' => 'Mês da ultima Parcela',
            'value' => 'Valor total da compra',
            'first_value_installment' => 'Valor da primeira parcela',
            'value_installments' => 'Valor das parcelas',
            'description' => 'Descrição da compra',
        ];
    }

    public function cards(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'card_id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }

    public function categoryShopping(): BelongsTo
    {
        return $this->belongsTo(CategoryShopping::class, 'category_id');
    }

    public static function getDatesFirstAndLastPaymentByCard($date_shopping, $card_id, $numberInstallments)
    {

        $month_shopping = explode('-', $date_shopping)[1];
        $year_shopping = explode('-', $date_shopping)[0];
        $day_limit_expired_card = Card::find($card_id)->day_expiration;
        $date_finish_interval = Carbon::parse($day_limit_expired_card . '-' . $month_shopping . '-' . $year_shopping);
        $date_init_interval = (clone $date_finish_interval)->subMonth();
        $date_shopping = Carbon::parse($date_shopping);
        $date_first_installments = Carbon::parse('01-' . $month_shopping . '-' . $year_shopping);
        if ($date_shopping < $date_finish_interval and $date_shopping >= $date_init_interval) {
            $data['date_first_installment'] = $date_first_installments;
        } else {
            $data['date_first_installment'] = $date_first_installments->addMonth();
        }
        $data['date_last_installment'] = (clone $date_first_installments)->addMonths($numberInstallments);
        return $data;
    }

    public static function getLaunchsMonth($interval)
    {
        $user_id = Auth::user()->id;
        $launchs['installments'] = ShoppingLaunch::where('date_first_installment', '<=', $interval[0])
            ->where('date_last_installment', '>=', $interval[1])->where('user_id',$user_id)->get();
        $launchs['valueInvoice'] = 0;
        foreach ($launchs['installments'] as $launch) {
            if ($launch->date_first_installment == $interval[0]->format('Y-m-d')) {
                $launch['InvoiceNow'] = 1;
                $launch['installmentNow'] = $launch->first_value_installment;
                $launchs['valueInvoice'] += $launch->first_value_installment;
            }else {

                $cont = 0;
                $dateInstallment = Carbon::parse($launch->date_first_installment);
                while ($dateInstallment<=$interval[0]){
                    $cont+=1;
                    $dateInstallment->addMonth();
                }
                $launch['InvoiceNow'] = $cont;
                unset($cont);
                unset($dateInstallment);
                $launch['installmentNow'] = $launch->value_installments;
                $launchs['valueInvoice'] += $launch->value_installments;
            }
        }
        return $launchs;
    }

    public function getShoppingLaunchByUser(){
        $user_id = Auth::user()->id;
        return ShoppingLaunch::where('user_id',$user_id)->get();
    }

    use SoftDeletes;
}
