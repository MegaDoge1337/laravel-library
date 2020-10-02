@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if($error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Books List</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">№</th>
                                <th scope="col">Author</th>
                                <th scope="col">Title</th>
                                <th scope="col">Year of publication</th>
                                <th scope="col">Place of publication</th>
                                <th scope="col">Price</th>
                                <th scope="col" colspan="3">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <th scope="row">{{ $book['id'] }}</th>
                                    <td>{{ $book['author'] }}</td>
                                    <td>
                                        @if($book['existence'])
                                            <a class="btn btn-light" href="{{ route('books.single', $book['id']) }}"
                                               role="button">{{ $book['title'] }}</a>
                                        @else
                                            <a class="btn btn-danger" href="{{ route('books.single', $book['id']) }}"
                                               role="button">{{ $book['title'] }}</a>
                                        @endif
                                    </td>
                                    <td>{{ $book['year_of_publication'] }}</td>
                                    <td>{{ $book['place_of_publication'] }}</td>
                                    <td>{{ $book['price'] }}</td>
                                    <td>
                                        <form action="{{ route('contracts.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="book_id" value="{{ $book['id'] }}">
                                            <button class="btn btn-primary">Contract</button>
                                        </form>
                                    </td>
                                    @if($user->isAdmin)
                                        <td>
                                            <form action="{{ route('books.delete', $book['id']) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a class="btn btn-dark" href="{{ route('books.edit', $book['id']) }}"
                                                   role="button">Update</a>
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
