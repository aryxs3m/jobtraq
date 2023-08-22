<div class="mb-3">
    <label class="form-label">Név</label>
    <input type="text" class="form-control" name="name" @if($item) value="{{ $item->name }}"@endif>
</div>
<div class="mb-3">
    <label class="form-label">Szülő pozíció</label>
    <select class="form-control" name="job_position_id">
        <option value="">-- nincs --</option>
        @foreach($positions as $position)
            <option value="{{ $position->id }}" @if($item && $item->job_position_id === $position->id) selected @endif>{{ $position->name }}</option>
        @endforeach
    </select>
    <p class="small text-muted">
        Szülő pozíció esetén csak a szülő pozícióra illő álláshirdetésekre lesz vizsgálva ez a pozíció.
    </p>
</div>
<div class="mb-3">
    <label class="form-label">Kulcsszavak</label>
    <textarea name="keywords" class="form-control" placeholder="Vesszővel válaszd el a kulcsszavakat!">@if($item){{ implode(',', $item->keywords) }}@endif</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Statisztikából elrejtve</label>
    <select class="form-control" name="hidden_in_statistics">
        <option value="0" @if($item->hidden_in_statistics === 0) selected @endif>Nem</option>
        <option value="1" @if($item->hidden_in_statistics === 1) selected @endif>Igen</option>
    </select>
    <p class="small text-muted">
        Szülő pozíciókhoz vagy teszteléshez. Ezekről a pozíciókról pl. nem lesznek chartok a főoldalon.
    </p>
</div>
<button type="submit" class="btn btn-primary">Mentés</button>
