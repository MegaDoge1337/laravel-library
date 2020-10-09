@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Error</div>
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                        @if(Auth::user())
                            <a class="btn btn-primary" href="{{ route('home') }}" role="button">Home</a>
                        @else
                            <a class="btn btn-primary" href="{{ route('login') }}" role="button">Login</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
