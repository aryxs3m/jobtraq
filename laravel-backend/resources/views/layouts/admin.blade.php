@extends('layouts.html')
@section('body')
<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="/">{{ config('app.name') }}</a>

    <ul class="navbar-nav flex-row d-md-none">
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle search">
                <i class="fas fa-search"></i>
            </button>
        </li>
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
        </li>
    </ul>

    <div id="navbarSearch" class="navbar-search w-100 collapse">
        <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
    </div>
</header>

<div class="container-fluid">
    <div class="row" id="content-row">
        @include('includes.sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3">
            @yield('content')
        </main>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.5/af-2.6.0/b-2.4.1/b-colvis-2.4.1/b-html5-2.4.1/b-print-2.4.1/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.10.0/r-2.5.0/rg-1.4.0/rr-1.4.1/sc-2.2.0/sb-1.5.0/sp-2.2.0/sl-1.7.0/sr-1.3.0/datatables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js" integrity="sha384-gdQErvCNWvHQZj6XZM0dNsAoY4v+j5P1XDpNkcM3HJG1Yx04ecqIHk7+4VBOCHOG" crossorigin="anonymous"></script>

<script>
    // TODO: resourcees alá tenni?
    function logout() {
        $.ajax({
            url: '/logout',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
            },
            complete: () => {
                window.location.href = '/login';
            }
        })
    }

    function crudDelete(button) {
        let btn = $(button);

        if (confirm('Biztos törlöd?')) {
            $.ajax({
                url: btn.data('action'),
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                complete: () => {
                    window.location.reload();
                }
            })
        }
    }

    $(function () {
        $(".btn-crud-delete").on('click', function () {
            crudDelete(this);
        });
    });
</script>

@stack('scripts')
@endsection
