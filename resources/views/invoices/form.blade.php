<form method="post" action="{{ route('invoices.search') }}">
    @csrf
    <label for="date_from">Date From</label>
    <input type="date" name="date_from" value="{{ $search['date_from']??old('date_from') }}">
    <label for="date_to">Date To</label>
    <input type="date" name="date_to" value="{{ $search['date_to']??old('date_to') }}">
    <label for="status">Status</label>
    <select name="status">
        <option disabled selected>Select status</option>
        @foreach($statuses as $status)
            <option {{ $search['status']==$status->status?'selected':'' }} value="{{ $status->status }}">{{ $status->status }}</option>
        @endforeach
    </select>
    <label for="location">Location</label>
    <select name="location">
        <option disabled selected>Select location</option>
        @foreach($locations as $location)
            <option {{ $search['location']==$location->id?'selected':'' }} value="{{ $location->id }}">{{ $location->name }}</option>
        @endforeach
    </select>
    <a href="{{ route('invoices') }}"><button type="button">Clear</button></a>
    <button type="submit">Search</button>
</form>