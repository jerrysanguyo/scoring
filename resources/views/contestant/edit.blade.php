@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-3">Category update</span>
                <a href="{{ route('admin.contestant.index') }}" class="text-decoration-none">
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
                    <form action="{{ route('admin.contestant.update', $contestant->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="col-lg-12">
                            <label for="name" class="form-label">Contestant name:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $contestant->name }}" required>
                        </div>
                        <div class="col-lg-12">
                            <label for="barangay" class="form-label">Barangay:</label>
                            <select name="barangay" id="barangay" class="form-select">
                                @foreach($barangays as $barangay)
                                    <option value="{{ $barangay }}" {{ $contestant->barangay == $barangay ? 'selected' : '' }}>{{ $barangay }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label for="no_of_members">No. of members:</label>
                            <input type="number" name="no_of_members" id="no_of_members" class="form-control" value="{{ $contestant->no_of_members }}">
                        </div>
                        <div class="col-lg-12">
                            <label for="focal_person">Focal person:</label>
                            <input type="text" name="focal_person" id="focal_person" class="form-control" value="{{ $contestant->focal_person }}">
                        </div>
                        <div class="col-lg-12">
                            <label for="folk_dance_id">Folk Dance:</label>
                            <select name="folk_dance_id" id="folk_dance_id" class="form-select">
                                @foreach($getAllCategory as $category)
                                    <option value="{{ $category->id }}" {{ $contestant->folk_dance_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label for="dance_id">Dance:</label>
                            <select name="dance_id" id="dance_id" class="form-select">
                                @foreach($getAllDance as $dance)
                                    <option value="{{ $dance->id }}" {{ $contestant->dance_id == $dance->id ? 'selected' : '' }}>{{ $dance->name }}</option>
                                @endforeach
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
