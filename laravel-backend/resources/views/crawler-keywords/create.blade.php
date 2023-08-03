@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Scraper kulcsszavak</h2>

    @if(session()->has('success'))
        <p class="alert alert-success">Sikeres mentés.</p>
    @endif

    <form method="post" action="{{ route('scraper-keywords.store') }}">
        @csrf
        @include('crawler-keywords.form-elements')
    </form>
@endsection
