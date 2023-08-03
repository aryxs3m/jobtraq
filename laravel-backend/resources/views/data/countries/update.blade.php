@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Országok</h2>

    @if(session()->has('success'))
        <p class="alert alert-success">Sikeres mentés.</p>
    @endif

    <form method="post" action="{{ route('countries.update', ['country' => $item]) }}">
        @method('PUT')
        @csrf
        @include('data.countries.form-elements')
    </form>
@endsection
