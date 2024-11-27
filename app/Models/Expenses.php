<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
class Expenses extends Model
{
    protected $fillable = ['category_id', 'amount', 'description', 'date'];
    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

}
