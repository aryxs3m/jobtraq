@extends('layouts.list')

@section('content')
    <h2>Szintek</h2>

    <a href="/job-levels/add" class="btn btn-primary btn-success">Új</a>
    <a href="/job-levels/order" class="btn btn-primary btn-primary">Sorrendezés</a>

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
                    <a href="/job-levels/edit/{{ $item->id }}" class="btn btn-sm btn-primary">Szerkesztés</a>
                    <a href="/job-levels/delete/{{ $item->id }}" class="btn btn-sm btn-danger">Törlés</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
