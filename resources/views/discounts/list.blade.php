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
                        @if($user->isAdmin)
                            <a class="btn btn-success" href="{{ route('discounts.create') }}"
                               role="button">Add New Discount</a><br><br>
                        @endif

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">№</th>
                                <th scope="col">User number</th>
                                <th scope="col">Discount</th>
                                <th scope="col" colspan="3">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($discounts as $discount)
                                <tr>
                                    <th scope="row">{{ $discount['id'] }}</th>
                                    <td>{{ $discount['user_id'] }}</td>
                                    <td>{{ $discount['discount'] }} %</td>
                                    <td>
                                        <form action="{{ route('discounts.delete', $discount['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-dark" href="{{ route('discounts.edit', $discount['id']) }}"
                                               role="button">Update</a>
                                            <button class="btn btn-danger">Delete</button>
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
