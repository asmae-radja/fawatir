<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_payements',
        'montant_payements',
        'invoice_id'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
