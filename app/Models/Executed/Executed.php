<?php

namespace App\Models\Executed;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Executed extends Model
{
    use HasFactory;

    protected $fillable = ['total_orders', 'total_cost'];
}
