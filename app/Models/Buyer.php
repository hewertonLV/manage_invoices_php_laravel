<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Buyer extends Model
{
    use HasFactory;

    public function shoppingLaunch(): HasMany
    {
        return $this->hasMany(shoppingLaunch::class, 'idBuyer');
    }

    protected $table = 'buyers';
    protected $fillable = ['name', 'user_id','description'];

    public function attributes()
    {
        return [
            'user_id' => 'Id do usuario',
            'name' => 'Responsavel',
            'description' => 'Descrição do Responsavel'
        ];
    }

    public function inputs($buyer)
    {
        return [
            'user_id' => $buyer->name,
            'name' => $buyer->name,
            'description' => $buyer->description,
        ];
    }

    public function getBuyerByUser(){
        $user_id = Auth::user()->id;
        return Buyer::where('user_id',$user_id)->get();
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
