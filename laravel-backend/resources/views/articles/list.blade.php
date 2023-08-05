@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Hírek</h2>

    <div class="mb-4 border-bottom pb-4">
        <a href="{{ route('articles.create') }}" class="btn btn-sm btn-primary btn-success">Új</a>
    </div>

    <table class="table" style="width: 100%">
        <thead>
        <tr>
            <td>ID</td>
            <td>Létrehozás</td>
            <td>Címe</td>
            <td>Állapot</td>
            <td>Műveletek</td>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->title }}</td>
                <td>
                    @if($item->published)
                        <i class="fas fa-check" title="Publikált"></i>
                    @else
                        <i class="fas fa-ban" title="Nem publikált"></i>
                    @endif
                </td>
                <td>
                    <a href="{{ route('articles.edit', ['article' => $item]) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil"></i></a>
                    <a target="_blank" href="{{ config('app.frontend_base_url').'/news/'.$item->slug }}" class="btn btn-sm btn-secondary"><i class="fas fa-eye"></i></a>
                    <a href="#" data-action="{{ route('articles.destroy', ['article' => $item->id]) }}" class="btn btn-sm btn-danger btn-crud-delete"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
