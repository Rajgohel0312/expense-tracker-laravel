<?php

namespace App\Models;

use Eloquent;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Database\Eloquent\Model;
use App\Models\Expenses;
class Categories extends Model
{
    protected $fillable = ['category_name'];

}
