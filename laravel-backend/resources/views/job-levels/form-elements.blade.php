<div class="mb-3">
    <label class="form-label">Név</label>
    <input type="text" class="form-control" name="name" @if($item) value="{{ $item->name }}"@endif>
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Kulcsszavak</label>
    <textarea name="keywords" class="form-control" placeholder="Vesszővel válaszd el a kulcsszavakat!">@if($item){{ implode(',', $item->keywords) }}@endif</textarea>
</div>
<button type="submit" class="btn btn-primary">Mentés</button>
