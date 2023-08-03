@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Helyek</h2>

    @if(session()->has('success'))
        <p class="alert alert-success">Sikeres mentés.</p>
    @endif

    <form method="post" action="{{ route('locations.store') }}">
        @csrf
        @include('data.locations.form-elements')
    </form>
@endsection
