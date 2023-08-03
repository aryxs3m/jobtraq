<div class="mb-3">
    <label class="form-label">Név</label>
    <input type="text" class="form-control" name="location" @if($item) value="{{ $item->location }}"@endif>
</div>
<div class="mb-3">
    <label class="form-label">Ország</label>
    <select class="form-control" name="country">
        @foreach($countries as $country)
            <option value="{{ $country->id }}"
                    @if($item && $item->country_id === $country->id) selected @endif>{{ $country->name }}</option>
        @endforeach
    </select>
</div>
<button type="submit" class="btn btn-primary">Mentés</button>
