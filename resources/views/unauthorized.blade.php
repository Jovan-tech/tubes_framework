@extends('layoutbootstrap')

@section('konten')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                

                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        {{ __('Sorry, you are not authorized to access this page.') }}
                    </div>
                    <p>Please contact the administrator for assistance or go back to <a href="{{ route('dashboardbootstrap') }}">dashboard</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
