@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Szintek</h2>

    <div class="mb-4 border-bottom pb-4">
        <a href="{{ route('job-levels.create') }}" class="btn btn-sm btn-primary btn-success">Új</a>
        <a href="{{ route('job-level-order.order') }}" class="btn btn-sm btn-primary btn-primary">Sorrendezés</a>
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
