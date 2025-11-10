<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use UUID;

    protected $fillable = [
        'store_balance_id',
        'amount',
        'bank_account_name',
        'bank_account_number',
        'bank_name',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    // withdrawal belongs to one store balance
    public function storeballance()
    {
        return $this->belongsTo(StoreBallances::class, 'store_balance_id');
    }
}
