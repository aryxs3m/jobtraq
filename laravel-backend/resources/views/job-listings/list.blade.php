@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Álláshirdetések</h2>

    @if(session()->has('success'))
        <p class="alert alert-success">{{ session()->get('success') }}</p>
    @endif

    <div class="card mb-3">
        <div class="card-body">
            <a href="{{ route('job-listings.full-reparse') }}" class="btn btn-warning btn-sm">Reparse</a>
            <a href="{{ route('job-listings.scrape') }}" class="btn btn-secondary btn-sm">Scrape</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
