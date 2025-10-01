@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-3">Scoring</span>
                <a href="{{ route('admin.home') }}" class="text-decoration-none">
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
                    
                    @foreach($nameOfContestant as $contestant)
                        <span class="fs-3">{{ $contestant->name }}</span>
                    @endforeach

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Criteria</th>
                                <th>Score</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listOfCriteria as $criteria)
                            <tr>
                                <td>
                                    {{ $criteria->name }}
                                    <input type="number" name="criteria_id" id="criteria_id" class="form-control" value="{{ $criteria->id }}" hidden>
                                </td>
                                <td>
                                    <input type="number" name="score" id="score" class="form-control">
                                </td>
                                <td>
                                    <input type="submit" value="submit" class="btn btn-primary">
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
@endsection
