@extends('layouts.app')

@section('content')
<div class="container" id="app">
    <all-statuses></all-statuses>
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dobrodošli') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Ulogovani ste') }}
                    
                </div>
                 <div>
                    <form action="/upload" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image">
                    <input type="submit" value="Upload">
                    </form>
                </div>

                
            </div>
        </div>
    </div> -->
</div>
@endsection
