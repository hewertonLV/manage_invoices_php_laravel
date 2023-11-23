<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class CategoryShopping extends Model
{
    use HasFactory;
    public function shoppingLaunch(): HasMany
    {
        return $this->hasMany(shoppingLaunch::class, 'category_id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $table = 'category_shoppings';
    protected $fillable = ['name','user_id'];

    public function attributes()
    {
        return [
            'name' => 'Nome',
            'user_id' => 'Id do Usuario'
        ];
    }
    public function inputs($category)
    {
        return [
            'name' => $category->name,
            'user_id' => $category->user_id,
        ];
    }

    public function getCategoryByUser(){
        $user_id = Auth::user()->id;
        return CategoryShopping::where('user_id',$user_id)->get();
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
