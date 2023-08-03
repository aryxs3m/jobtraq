@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Stackek</h2>

    <div class="mb-4 border-bottom pb-4">
        <a href="{{ route('job-stacks.create') }}" class="btn btn-sm btn-primary btn-success">Új</a>
    </div>

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
                    <a href="{{ route('job-stacks.edit', ['job_stack' => $item]) }}" class="btn btn-sm btn-primary">Szerkesztés</a>
                    <a href="#" data-action="{{ route('job-stacks.destroy', ['job_stack' => $item->id]) }}" class="btn btn-sm btn-danger btn-crud-delete">Törlés</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
