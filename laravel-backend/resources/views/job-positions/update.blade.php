@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Pozíciók</h2>

    @if(session()->has('success'))
        <p class="alert alert-success">Sikeres mentés.</p>
    @endif

    <form method="post" action="{{ route('job-positions.update', ['job_position' => $item]) }}">
        @method('PUT')
        @csrf
        @include('job-positions.form-elements')
    </form>
@endsection
