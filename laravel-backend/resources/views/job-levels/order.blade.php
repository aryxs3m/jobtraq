@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Szintek rendezése</h2>

    <form method="post" action="{{ route('job-level-order.order-post') }}">
        @csrf
        <ul id="bar" class="list-group">
            @foreach($levels as $level)
                <li class="list-group-item">
                    <i class="fas fa-bars text-muted me-2"></i> {{ $level->name }}
                    <input type="hidden" name="order[]" value="{{ $level->id }}">
                </li>
            @endforeach
        </ul>

        <button type="submit" class="btn btn-success mt-3" onclick="saveOrder()">Mentés</button>
    </form>
@endsection

@push('scripts')
    <!-- Sortable.js -->
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>

    <script>
        Sortable.create(bar, {
            group: {
                name: 'bar',
                pull: true
            },
            animation: 100
        });
    </script>
@endpush
