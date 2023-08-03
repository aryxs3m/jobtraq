@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Stackek</h2>

    @if(session()->has('success'))
        <p class="alert alert-success">Sikeres mentés.</p>
    @endif

    <form method="post" action="{{ route('job-stacks.store') }}">
        @csrf
        @include('job-stacks.form-elements')
    </form>
@endsection
