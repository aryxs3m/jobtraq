<div class="mb-3">
    <label class="form-label">Név</label>
    <input type="text" class="form-control" name="name" @if($item) value="{{ $item->name }}"@endif>
</div>
<div class="mb-3">
    <label class="form-label">Kapcsolódó pozíció</label>
    <select class="form-control" name="job_position">
        <option value="">-- nincs --</option>
        @foreach($positions as $position)
            <option value="{{ $position->id }}" @if($item && $item->job_position_id === $position->id) selected @endif>{{ $position->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Kulcsszavak</label>
    <textarea name="keywords" class="form-control" placeholder="Vesszővel válaszd el a kulcsszavakat!">@if($item){{ implode(',', $item->keywords) }}@endif</textarea>
</div>
<button type="submit" class="btn btn-primary">Mentés</button>
