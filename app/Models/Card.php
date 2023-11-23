<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';
    protected $fillable = [
        'name',
        'buyer_id',
        'user_id',
        'amount_limit',
        'day_expiration'
    ];
    public function inputs($card)
    {
        return [
            'name' => $card->name,
            'buyer_id' => $card->buyer_id,
            'user_id' => $card->buyer_id,
            'amount_limit' => $card->amount_limit,
            'day_expiration' => $card->day_expiration
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nome do Cartão',
            'buyer_id' => 'id do Responsavel',
            'user_id' => 'id do Usuario',
            'amount_limit' => 'Limite Total',
            'day_expiration' => 'Dia do vencimento'
        ];
    }
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shoppingLaunch(): HasMany
    {
        return $this->hasMany(shoppingLaunch::class, 'card_id');
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(buyer::class, 'buyer_id');
    }

    public function getCardByUser(){
        $user_id = Auth::user()->id;
        return Card::where('user_id',$user_id)->get();
    }

    public function label()
    {
        return $this->name;
    }
    public function value()
    {
        return $this->id;
    }
    use SoftDeletes;
}
