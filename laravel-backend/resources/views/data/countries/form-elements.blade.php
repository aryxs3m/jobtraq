<div class="mb-3">
    <label class="form-label">Név</label>
    <input type="text" class="form-control" name="name" @if($item) value="{{ $item->name }}"@endif>
    </select>
</div>
<button type="submit" class="btn btn-primary">Mentés</button>
