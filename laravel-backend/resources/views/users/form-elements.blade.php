<div class="mb-3">
    <label class="form-label">Név</label>
    <input type="text" name="name" class="form-control" @if($item) value="{{ $item->name }}"@endif>
</div>
<div class="mb-3">
    <label class="form-label">E-mail</label>
    <input type="email" name="email" class="form-control" @if($item) value="{{ $item->email }}"@endif>
</div>
<div class="mb-3">
    <label class="form-label">Új jelszó</label>
    <input type="password" name="password" class="form-control">
</div>
<div class="mb-3">
    <label class="form-label">Szerepkörök</label>
    <div class="ps-3">
        @foreach($roles as $role)
            <div class="form-check form-switch">
                <input name="roles[]" value="{{ $role->name }}" class="form-check-input" @if($item && $item->hasRole($role)) checked @endif type="checkbox" role="switch" id="roleSwitch{{ str_replace(' ', '-', $role->name) }}">
                <label class="form-check-label" for="roleSwitch{{ str_replace(' ', '-', $role->name) }}">{{ $role->name }}</label>
            </div>
        @endforeach
    </div>
</div>
<button type="submit" class="btn btn-primary">Mentés</button>
