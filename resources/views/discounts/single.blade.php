@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Single Book</div>
                    <div class="card-body">
                        @if($book['existence'])
                            <form action="{{ route('contracts.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book['id'] }}">
                                <button class="btn btn-primary">Contract</button>
                            </form>
                            <br>
                        @else
                            <div class="alert alert-danger" role="alert">
                                Book not in stock!
                            </div>
                        @endif
                        <h3>{{ $book['title'] }}</h3>
                        <ul class="list-group">
                            <li class="list-group-item">Author: {{ $book['author'] }}</li>
                            <li class="list-group-item">Year of publication: {{ $book['year_of_publication'] }}</li>
                            <li class="list-group-item">Place of publication: {{ $book['place_of_publication'] }}</li>
                            <li class="list-group-item">Price: {{ $book['price'] }}</li>
                        </ul>
                        <br> <a class="btn btn-dark" href="{{ redirect()->back()->getTargetUrl() }}"
                           role="button">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
