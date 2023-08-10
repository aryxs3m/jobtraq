@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Képek</h2>

    <form action="{{ route('images.store') }}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="card">
            <div class="card-body d-flex flex-row">
                <input type="file" class="form-control" name="image">
                <button type="submit" class="btn btn-primary">Feltöltés</button>
            </div>
        </div>
    </form>

    <div id="image-board" class="row row-cols-2 row-cols-md-4 mt-4">
        @foreach($images as $image)
            <div class="col">
                <div class="card image-card" style="">
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-between mb-2">
                            <span class="p-2 small text-nowrap text-truncate">{{ $image->filename }}</span>
                            <div class="text-nowrap">
                                <button onclick="copyUrl(this)" data-url="{{ $image->external_url }}" class="btn btn-sm btn-primary"><i class="fas fa-copy"></i></button>
                                <button data-action="{{ route('images.destroy', ['image' => $image->id]) }}" class="btn btn-sm btn-danger btn-crud-delete"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="text-center">
                            <img src="{{ $image->url }}" alt="{{ $image->filename }}" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('scripts')
    <script>
        function copyUrl(btn) {
            // Copy the text inside the text field
            navigator.clipboard.writeText($(btn).data('url'));
        }
    </script>
@endpush
