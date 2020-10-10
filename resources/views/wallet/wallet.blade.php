@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Wallet</div>
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Your Wallet</h4>
                        <p>Bill: {{ $wallet['bill'] }} $</p>
                        <hr>
                        <p class="mb-0"><a href="#" class="alert-link">Fill up the wallet</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
