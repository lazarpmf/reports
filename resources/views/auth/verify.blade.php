@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Potvrdite Vašu email adresu') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Verifikacioni link je poslat na Vašu email adresu.') }}
                        </div>
                    @endif

                    {{ __('Prije nastavka, molimo provjerite Vašu poštu. Poslat Vam je verifikacioni link.') }}
                    {{ __('Ako niste primili email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('kliknite ovdje kako bismo Vam poslali opet.') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
