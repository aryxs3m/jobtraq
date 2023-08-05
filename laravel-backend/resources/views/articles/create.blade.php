@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Hírek</h2>

    @if(session()->has('success'))
        <p class="alert alert-success">Sikeres mentés.</p>
    @endif

    <form method="post" action="{{ route('articles.store') }}">
        @if($item)
            <input type="hidden" name="id" value="{{ $item->id }}">
        @endif
        @csrf
        @include('articles.form-elements')
    </form>
@endsection
