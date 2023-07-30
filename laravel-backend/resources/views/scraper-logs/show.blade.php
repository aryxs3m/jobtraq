@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Scraper napló</h2>

    <div class="list-group">
        <div class="list-group-item">
            <strong>Típus:</strong> {{ $log->log['name'] }}
        </div>
        <div class="list-group-item">
            <strong>Üzenet:</strong> {{ $log->log['message'] }}
        </div>
        <div class="list-group-item">
            <strong>Trace:</strong>
            <pre>@json($log->log['trace'])</pre>
        </div>
    </div>
@endsection
