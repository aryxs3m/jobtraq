@extends('layouts.list')

@section('content')
    <h2>Crawler kulcsszavak</h2>

    @if(session()->has('success'))
        <p class="alert alert-success">Sikeres mentés.</p>
    @endif

    <form method="post">
        @if($item)
            <input type="hidden" name="id" value="{{ $item->id }}">
        @endif
        @csrf
        <div class="mb-3">
            <label class="form-label">Crawler service</label>
            <select name="crawler" class="form-control">
                @foreach($services as $service)
                    <option @if($item && $item->crawler == $service) selected @endif value="{{ $service }}">{{ $service }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Kulcsszavak</label>
            <textarea name="keywords" class="form-control" placeholder="Vesszővel válaszd el a kulcsszavakat!">@if($item){{ implode(',', $item->keywords) }}@endif</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
