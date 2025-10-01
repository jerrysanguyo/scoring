@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-3">Dance update</span>
                <a href="{{ route('admin.dance.index') }}" class="text-decoration-none">
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
                    <form action="{{ route('admin.dance.update', ['dance' => $dance->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="col-lg-12">
                            <label for="name" class="form-label">dance name:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $dance->name }}">
                        </div>
                        <input type="submit" value="Update" class="btn btn-primary mt-3">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
