@extends('layouts.auth')

@section('content')
<div class="auth">
    <div class="row auth-row g-0">
        <div class="col bg-col d-flex flex-column">
            <img src="logo_Light.svg" alt="JobTraq Logo" class="p-5" style="max-width: 300px;">
            <p class="ms-5 mb-5 mt-auto small">
                Image by <a href="https://www.freepik.com/free-photo/fern-leaves-black-background_2518455.htm#query=dark%20plants&position=12&from_view=search&track=ais">Freepik</a>
            </p>
        </div>
        <div class="col-4 form-col bg-dark-subtle">
            <div class="container d-flex flex-column justify-content-center px-5">
                <h3 class="mb-4">
                    <i class="fas fa-lock me-2"></i>
                    Adminisztráció
                </h3>

                <form method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label>E-mail cím</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="form-group mb-4">
                        <label>Jelszó</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-dark">Belépés</button>
                    </div>

                    <p class="text-muted small mt-3 text-end">
                        {{ config('app.name') }} &mdash; v{{ config('app.version') }}
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
