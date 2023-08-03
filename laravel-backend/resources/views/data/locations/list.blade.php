@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Helyek</h2>

    <div class="mb-4 border-bottom pb-4">
        <a href="{{ route('locations.create') }}" class="btn btn-sm btn-primary btn-success">Új</a>
    </div>

    <table class="table" style="width: 100%">
        <thead>
        <tr>
            <td>ID</td>
            <td>Név</td>
            <td>Műveletek</td>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->location }}</td>
                <td>
                    <a href="{{ route('locations.edit', ['location' => $item]) }}" class="btn btn-sm btn-primary">Szerkesztés</a>
                    <a href="#" data-action="{{ route('locations.destroy', ['location' => $item->id]) }}" class="btn btn-sm btn-danger btn-crud-delete">Törlés</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
