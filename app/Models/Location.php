<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Location extends Model
{
    use HasFactory;

    public function invoiceHeaders()
    {
        return $this->hasMany(InvoiceHeader::class);
    }

    public function getInvoiceSums(): array
    {
        $statuses = DB::table('locations')
            ->select('invoice_headers.status', 'invoice_lines.value')
            ->join('invoice_headers', 'locations.id', '=', 'invoice_headers.location_id')
            ->join('invoice_lines', 'invoice_headers.id', '=', 'invoice_lines.invoice_header_id')
            ->groupBy('invoice_headers.status', 'invoice_lines.value')
            ->where('locations.id', $this->id)
            ->get();
        $return = [];

        if ($statuses){
            foreach ($statuses as $status) {
                if (isset($return[$status->status])){
                    $return[$status->status] += $status->value;
                } else {
                    $return[$status->status] = $status->value;
                }
            }
        }
        
        return $return;
    }
}
