@if($item)
    <div class="card mb-3">
        <div class="card-header">
            Technikai adatok
        </div>
        <div class="card-body">
            <div class="list-group list-group-flush">
                <div class="list-group-item">
                    Állapot: <strong>{{ $item->published ? 'publikált' : 'nem publikált' }}</strong>
                </div>
                <div class="list-group-item">
                    Publikálás ideje: <strong>{{ $item->published_at ?? 'N/A' }}</strong>
                </div>
                <div class="list-group-item">
                    Létrehozó: <strong>{{ $item->user->name }}</strong>
                </div>
                <div class="list-group-item">
                    Slug: <strong>{{ $item->slug }}</strong>
                </div>

            </div>
        </div>
    </div>
@endif

<div class="mb-3">
    <label class="form-label">Cím</label>
    <input type="text" class="form-control" name="title" @if($item) value="{{ $item->title }}"@endif>
</div>
<div class="mb-3">
    <label class="form-label">Bevezető</label>
    <textarea type="text" class="form-control" name="introduction">@if($item){{ $item->introduction }}@endif</textarea>
</div>
<div class="mb-3">
    <label class="form-label">Publikált</label>
    <select type="checkbox" class="form-control" name="published">
        <option value="0" @if($item && !$item->published) selected @endif>Nem</option>
        <option value="1" @if($item && $item->published) selected @endif>Igen</option>
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Kép URL</label>
    <input type="url" class="form-control" name="image_url" value="@if($item){{ $item->image_url }}@endif">
</div>
<div class="mb-3">
    <label class="form-label">Tartalom (Markdown)</label>
    <textarea type="text" class="form-control" name="content">@if($item){{ $item->content }}@endif</textarea>
</div>
<button type="submit" class="btn btn-primary">Mentés</button>
