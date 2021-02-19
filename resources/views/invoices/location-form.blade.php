<form method="post" action="{{ route('invoices.locations.search') }}">
    @csrf
    <label for="location">Location</label>
    <select name="location">
        <option disabled selected>Select location</option>
        @foreach($locations as $location)
            <option {{ $search['location']==$location->id?'selected':'' }} value="{{ $location->id }}">{{ $location->name }}</option>
        @endforeach
    </select>
    <button type="submit">Search</button>
</form>