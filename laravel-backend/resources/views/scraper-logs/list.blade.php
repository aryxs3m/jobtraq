@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Scraper naplók</h2>

    <div class="card">
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
