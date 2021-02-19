@extends('layouts.kitchencut')
@section('content')
    @include('invoices.location-form')
    <h2>{{ $location->name }}</h2>
    <table>
        <tr>
            <th>Status</th>
            <th>Total Value</th>
        </tr>
        @foreach ($statuses as $status => $value)
            <tr>
                <td>{{ $status }}</td>
                <td>£{{ $value }}</td>
            </tr>
        @endforeach
    </table>
@endsection