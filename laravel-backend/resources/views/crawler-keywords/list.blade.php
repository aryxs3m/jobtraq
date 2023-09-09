@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Scraper kulcsszavak</h2>

    <div class="mb-4 border-bottom pb-4">
        <a href="{{ route('scraper-keywords.create') }}" class="btn btn-sm btn-primary btn-success">Új</a>
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
