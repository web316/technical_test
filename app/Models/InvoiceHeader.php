<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceHeader extends Model
{
    use HasFactory;

    protected $casts = [
        'date' => 'datetime:Y-m-d',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function invoiceLines()
    {
        return $this->hasMany(InvoiceLine::class);
    }

    public function invoiceTotal(): float
    {
        $total = 0;
        if ($this->invoiceLines){
            foreach ($this->invoiceLines as $invoiceLine) {
                $total += $invoiceLine->value;
            }
        }

        return $total;
    }
}
