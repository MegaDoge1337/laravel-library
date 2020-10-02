@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Adding book</div>
                    <div class="card-body">
                        <form action="{{ route('books.store') }}" method="POST">
                            @csrf
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Title:
                                    <div class="input-group flex-nowrap">
                                        <input name="title" type="text" class="form-control" placeholder="Example: The Lord of the Rings"
                                               aria-label="Username" aria-describedby="addon-wrapping">
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    Author:
                                    <div class="input-group flex-nowrap">
                                        <input name="author" type="text" class="form-control" placeholder="Example: J.R.R. Tolkien"
                                               aria-label="Username" aria-describedby="addon-wrapping">
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    Year of publication:
                                    <div class="input-group flex-nowrap">
                                        <input name="year_of_publication" type="text" class="form-control" placeholder="Example: 1954"
                                               aria-label="Username" aria-describedby="addon-wrapping">
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    Place of publication:
                                    <div class="input-group flex-nowrap">
                                        <input name="place_of_publication" type="text" class="form-control" placeholder="Example: United Kingdom"
                                               aria-label="Username" aria-describedby="addon-wrapping">
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    Price:
                                    <div class="input-group flex-nowrap">
                                        <input name="price" type="text" class="form-control" placeholder="Example: 16"
                                               aria-label="Username" aria-describedby="addon-wrapping">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-wrapping">$</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <br><a class="btn btn-dark" href="{{ redirect()->back()->getTargetUrl() }}" role="button">Back</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
