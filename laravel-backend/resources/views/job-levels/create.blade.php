@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Szintek</h2>

    @if(session()->has('success'))
        <p class="alert alert-success">Sikeres mentés.</p>
    @endif

    <form method="post" action="{{ route('job-levels.store') }}">
        @csrf
        @include('job-levels.form-elements')
    </form>
@endsection
