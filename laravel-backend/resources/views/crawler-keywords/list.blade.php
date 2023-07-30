@extends('layouts.list')

@section('content')
    <h2>Scraper kulcsszavak</h2>

    <a href="/scraper-keywords/add" class="btn btn-primary btn-success">Új</a>

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
