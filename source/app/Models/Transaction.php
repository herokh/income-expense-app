<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    public $timestamps = true;
    protected $dates = ['transaction_datetime'];
    protected $fillable = [
        'amount',
        'transaction_type',
        'transaction_datetime',
        'note',
        'created_by',
        'updated_by'
    ];
}
