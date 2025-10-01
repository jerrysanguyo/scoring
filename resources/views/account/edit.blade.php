@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-3">Account update</span>
                <a href="{{ route('admin.account.index') }}" class="text-decoration-none">
                    <button class="btn btn-primary">
                        Back
                    </button>
                </a>
            </div>
            <div class="card shadow border">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.account.update', ['account' => $account->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="col-lg-12">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $account->name }}" required>
                        </div>
                        <div class="col-lg-12">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{ $account->email }}" required>
                        </div>
                        <div class="col-lg-12">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" name="password" id="password" class="form-control" value="{{ $account->password }}" required>
                        </div>
                        <div class="col-lg-12">
                            <label for="type" class="form-label">Account type:</label>
                            <select name="type" id="type" class="form-select">
                                <option value="judge" {{ $account->type == 'judge' ? 'selected' : '' }}>Judge</option>
                                <option value="user" {{ $account->type == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>
                        <input type="submit" value="Update" class="btn btn-primary mt-3">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection