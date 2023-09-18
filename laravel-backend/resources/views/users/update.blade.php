@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Felhasználó szerkesztése</h2>

    @if(session()->has('success'))
        <p class="alert alert-success">Sikeres mentés.</p>
    @endif

    <form method="post" action="{{ route('users.update', ['user' => $item]) }}">
        @method('PUT')
        @csrf
        @include('users.form-elements')
    </form>
@endsection
