<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\SearchInvoiceRequest;
use App\Http\Requests\SearchLocationRequest;
use App\Models\InvoiceHeader;
use App\Models\Location;

class InvoiceController extends Controller
{
    public function index():View
    {
        $parameters = [
            'locations' => Location::all(),
            'statuses'  => $this->getStatuses(),
            'search'    => [
                'date_from' => old('date_from'),
                'date_to'   => old('date_to'),
                'status'    => old('status'),
                'location'  => old('location'),
            ],
            'pageHeading' => 'Search Invoices',
        ];

        return view('invoices.index', $parameters);
    }

    public function search(SearchInvoiceRequest $request):View
    {
        $query = InvoiceHeader::orderBy('date');
        if ($request->location){
            $query->where('location_id', $request->location);
        }

        if ($request->status){
            $query->where('status', $request->status);
        }

        if ($request->date_from || $request->date_to){
            $query->whereBetween('date', [$request->date_from??'1970-01-01', $request->date_to??date('Y-m-d')]);
        }
        
        $invoices = $query->get();

        $parameters = [
            'locations' => Location::all(),
            'statuses'  => $this->getStatuses(),
            'invoices'  => $invoices,
            'search'    => [
                'date_from' => $request->date_from,
                'date_to'   => $request->date_to,
                'status'    => $request->status,
                'location'  => $request->location,
            ],
            'pageHeading' => 'Search Invoice Results',
        ];

        return view('invoices.search', $parameters);
    }

    public function locations(): View
    {
        $parameters = [
            'locations' => Location::all(),
            'search'    => [
                'location'  => old('location'),
            ],
            'pageHeading' => 'Search Locations',
        ];

        return view('invoices.locations', $parameters);
    }

    public function locationSearch(SearchLocationRequest $request): View
    {
        $location = Location::find($request->location);
        $statuses = $location->getInvoiceSums();
        // dd($statuses);
        $parameters = [
            'locations' => Location::all(),
            'location'  => $location,
            'statuses'  => $statuses,
            'search'    => [
                'location'  => $request->location,
            ],
            'pageHeading' => 'Search Locations',
        ];

        return view('invoices.location-search', $parameters);
    }

    private function getStatuses():Collection
    {
        return DB::table('invoice_headers')
                ->select('status')
                ->distinct()
                ->get();
    }
}
