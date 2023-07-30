@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Scraper kulcsszavak</h2>

    <div class="mb-4 border-bottom pb-4">
        <a href="/scraper-keywords/add" class="btn btn-sm btn-primary btn-success">Új</a>
    </div>

    <table class="table" style="width: 100%">
        <thead>
        <tr>
            <td>ID</td>
            <td>Crawler</td>
            <td>Műveletek</td>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->crawler }}</td>
                <td>
                    <a href="/scraper-keywords/edit/{{ $item->id }}" class="btn btn-sm btn-primary">Szerkesztés</a>
                    <a href="/scraper-keywords/delete/{{ $item->id }}" class="btn btn-sm btn-danger">Törlés</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
