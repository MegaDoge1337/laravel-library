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
                    <div class="card-header">Contracts List</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">№</th>
                                <th scope="col">Book number</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contracts as $contract)
                                <tr>
                                    <th scope="row">{{ $contract['id'] }}</th>
                                    <td>{{ $contract['book_id'] }}</td>
                                    <td>
                                        <form action="{{ route('contracts.delete', $contract['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-primary" type="submit">Return</button>
                                        </form>
                                    </td>
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
