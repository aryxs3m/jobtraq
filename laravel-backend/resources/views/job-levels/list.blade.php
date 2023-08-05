@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Szintek</h2>

    <div class="mb-4 border-bottom pb-4">
        <a href="{{ route('job-levels.create') }}" class="btn btn-sm btn-primary btn-success">Új</a>
        <a href="{{ route('job-level-order.order') }}" class="btn btn-sm btn-primary btn-primary">Sorrendezés</a>
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
                    <a href="{{ route('job-levels.edit', ['job_level' => $item]) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil"></i></a>
                    <a href="#" data-action="{{ route('job-levels.destroy', ['job_level' => $item->id]) }}" class="btn btn-sm btn-danger btn-crud-delete"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
