@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Felhasználó létrehozása</h2>

    @if(session()->has('success'))
        <p class="alert alert-success">Sikeres mentés.</p>
    @endif

    <form method="post" action="{{ route('users.store') }}">
        @csrf
        @include('users.form-elements')
    </form>
@endsection
