@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-1">
            <span class="fs-3">Criteria</span>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                        Add criteria
                </button>
                @include('criteria.create')
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

                    <table class="table table-striped" id="criteria-table">
                        <thead>
                            <tr>
                                <th>Criteria name</th>
                                <th>Percentage</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listOfCriteria as $criteria)
                            <tr>
                                <td>{{ $criteria->name }}</td>
                                <td>{{ $criteria->percentage }}%</td>
                                <td>{{ $criteria->createdBy->name }}</td>
                                <td>{{ $criteria->updatedBy->name }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('admin.criteria.edit', ['criterion' => $criteria->id]) }}">Update</a></li>
                                            <li>
                                                <form id="delete-form-{{ $criteria->id }}" action="{{ route('admin.criteria.destroy', ['criterion' => $criteria->id]) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="dropdown-item" onclick="confirmDelete({{ $criteria->id }})">Delete criteria</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
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
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#criteria-table').DataTable({
                "processing": true,
                "serverSide": false,
                "pageLength": 10,
                "order": [[0, "desc"]],
            });
        });

        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this criteria?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endpush
@endsection
