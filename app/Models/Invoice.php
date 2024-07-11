<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_num',
        'invoice_date',
        'due_date',
        'product',
        'Amount_collection',
        'Amount_Commission',
        'discount',
        'value_vat',
        'rate_vat',
        'total',
        'status',
        'value_Status',
        'file_name', 'note',
        'user',
        'section_id',
    ];
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function payements()
    {
        return $this->hasMany(Payement::class);
    }
}
