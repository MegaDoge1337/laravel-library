@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Adding book</div>
                    <div class="card-body">
                        <form action="{{ route('discounts.update', $discount['id']) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <ul class="list-group">
                                <li class="list-group-item">
                                    User:
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">ID</label>
                                        </div>
                                        <select class="custom-select" id="inputGroupSelect01" name="user_id">
                                            @foreach($users as $user)
                                                @if($user->id == $discount['user_id'])
                                                    <option value="{{ $user->id }}" selected>{{ $user->id }}</option>
                                                @else
                                                    <option value="{{ $user->id }}">{{ $user->id }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    Discount:
                                    <div class="input-group flex-nowrap">
                                        <input name="discount" value="{{ $discount['discount'] }}" type="text"
                                               class="form-control" placeholder="Example: 16"
                                               aria-label="Username" aria-describedby="addon-wrapping">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-wrapping">%</span>
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
