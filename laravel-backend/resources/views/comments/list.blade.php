@php use App\Models\Enums\CommentStatus; @endphp

@extends('layouts.list')

@section('content')
    <h2 class="mb-4">Hozzászólások</h2>

    <div class="card mb-4">
        <div class="card-body">
            <form id="filter-form">
                <div class="d-flex">
                    <label for="status">Státusz szűrés</label>
                    <select name="status" id="status" class="form-control filter-input">
                        <option @if($status_filter === null) selected @endif value="">(nincs szűrés)</option>
                        <option @if($status_filter === CommentStatus::AWAITING_MODERATION->value) selected @endif value="{{ CommentStatus::AWAITING_MODERATION }}">Még nem moderáltak</option>
                        <option @if($status_filter === CommentStatus::APPROVED->value) selected @endif value="{{ CommentStatus::APPROVED }}">Engedélyezettek</option>
                        <option @if($status_filter === CommentStatus::DENIED->value) selected @endif value="{{ CommentStatus::DENIED }}">Tiltottak</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    @php
        /** @var \App\Models\Comment $comment */
    @endphp
    @foreach($comments as $comment)
        <div class="card mb-3">
            <div class="card-body">
                @switch($comment->status)
                    @case(CommentStatus::APPROVED)
                    <span class="badge bg-success">Elfogadva</span>
                    @break

                    @case(CommentStatus::DENIED)
                    <span class="badge bg-danger">Elutasítva</span>
                    @break

                    @case(CommentStatus::AWAITING_MODERATION)
                    <span class="badge bg-warning text-black">Még nincs moderálva</span>
                    @break
                @endswitch

                <div class="d-flex align-items-center my-2">
                    <span class="me-2 lead">{{ $comment->name }}</span>
                    <span class="flex-grow-1 small">{{ $comment->created_at->format('Y-m-d H:i:s') }}</span>
                    <span class="small text-muted">{{ $comment->ip_address }}</span>
                </div>

                {{ $comment->message }}
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    @if($comment->status === CommentStatus::AWAITING_MODERATION || $comment->status === CommentStatus::DENIED)
                        <button data-status="{{ CommentStatus::APPROVED }}" data-id="{{ $comment->id }}" class="btn btn-sm btn-success btn-comment-moderation me-2">Engedélyezés</button>
                    @endif

                    @if($comment->status === CommentStatus::AWAITING_MODERATION || $comment->status === CommentStatus::APPROVED)
                        <button data-status="{{ CommentStatus::DENIED }}" data-id="{{ $comment->id }}" class="btn btn-sm btn-danger btn-comment-moderation">Tiltás</button>
                    @endif

                    <span class="mx-3">|</span>

                    <button data-is-op="{{ $comment->is_op }}" data-id="{{ $comment->id }}" class="btn btn-sm btn-dark btn-comment-op-change">
                        <i class="fas @if($comment->is_op) fa-toggle-on @else fa-toggle-off @endif"></i> OP</button>
                </div>
            </div>
        </div>
    @endforeach

    {{ $comments->links() }}
@endsection

@push('scripts')
    <script>
        $(".btn-comment-moderation").on('click', function () {
            let btn = $(this);
            btn.attr('disabled', true);

            $.ajax({
                url: '{{ route('comments.update-moderation') }}',
                method: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    comment_id: btn.data('id'),
                    status: btn.data('status'),
                },
                success: function () {
                    btn.prepend('<i class="fas fa-check-circle"></i> ');
                },
                error: function (data) {
                    alert(data.message);
                }
            })
        })

        $(".btn-comment-op-change").on('click', function () {
            let btn = $(this);
            let isOp = btn.data('is-op') == '1';
            btn.attr('disabled', true);

            $.ajax({
                url: '{{ route('comments.update-op') }}',
                method: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    comment_id: btn.data('id'),
                    is_op: isOp ? '0' : '1',
                },
                success: function (data) {
                    btn.data('is-op', data.is_op);

                    if (data.is_op === '1') {
                        btn.html('<i class="fas fa-toggle-on"></i> OP');
                    }

                    if (data.is_op === '0') {
                        btn.html('<i class="fas fa-toggle-off"></i> OP');
                    }

                    btn.attr('disabled', false);
                },
                error: function (data) {
                    alert(data.message);
                }
            })
        })

        $(".filter-input").on('change', function () {
            $("#filter-form").submit();
        })
    </script>
@endpush
