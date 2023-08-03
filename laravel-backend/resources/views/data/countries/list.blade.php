@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Országok</h2>

    <div class="mb-4 border-bottom pb-4">
        <a href="{{ route('countries.create') }}" class="btn btn-sm btn-primary btn-success">Új</a>
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
                <td>{{ $item->name }}</td>
                <td>
                    <a href="{{ route('countries.edit', ['country' => $item]) }}" class="btn btn-sm btn-primary">Szerkesztés</a>
                    <a href="#" data-action="{{ route('countries.destroy', ['country' => $item->id]) }}" class="btn btn-sm btn-danger btn-crud-delete">Törlés</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
