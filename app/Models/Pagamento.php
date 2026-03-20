<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pagamento extends Model
{
    protected $fillable = [
        'user_id',
        'plano_id',
        'valor',
        'status',
        'gateway',
        'transaction_id',
        'vencimento',
    ];

    protected $casts = [
        'valor'      => 'decimal:2',
        'vencimento' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plano(): BelongsTo
    {
        return $this->belongsTo(Plano::class);
    }
}
