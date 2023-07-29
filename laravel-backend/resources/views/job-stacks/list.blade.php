@extends('layouts.list')

@section('content')
    <h2>Stackek</h2>

    <a href="/job-stacks/add" class="btn btn-primary btn-success">Új</a>

    <table class="table" style="width: 100%">
        <thead>
        <tr>
            <td>ID</td>
            <td>Név</td>
            <td>Pozíció</td>
            <td>Műveletek</td>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->jobPosition ? $item->jobPosition->name : '' }}</td>
                <td>
                    <a href="/job-stacks/edit/{{ $item->id }}" class="btn btn-sm btn-primary">Szerkesztés</a>
                    <a href="/job-stacks/delete/{{ $item->id }}" class="btn btn-sm btn-danger">Törlés</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
