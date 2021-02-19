@extends('layouts.kitchencut')
@section('content')
    @include('invoices.form')
    <table>
        <tr>
            <th>Location</th>
            <th>Date</th>
            <th>Status</th>
            <th>Total Value</th>
        </tr>
        @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $invoice->location->name }}</td>
                <td>{{ $invoice->date->format('d/m/Y') }}</td>
                <td>{{ ucfirst($invoice->status) }}</td>
                <td>£{{ $invoice->invoiceTotal() }}</td>
            </tr>
        @endforeach
    </table>
@endsection