@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-1">
            <span class="fs-3">Contestant</span>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                        Add contestant
                </button>
                @include('contestant.create')
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

                    <table class="table table-striped" id="contestant-table">
                        <thead>
                            <tr>
                                <th>Contestant name</th>
                                <th>Barangay</th>
                                <th>Folk dance category</th>
                                <th>Dance</th>
                                <th>No. of members</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($getAllContestants as $contestant)
                            <tr>
                                <td>{{ $contestant->name }}</td>
                                <td>{{ $contestant->barangay ?? 'N/A' }}</td>
                                <td>{{ $contestant->category->name ?? 'N/A' }}</td>
                                <td>{{ $contestant->dance->name ?? 'N/A' }}</td>
                                <td>{{ $contestant->no_of_members ?? 'N/A' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('admin.contestant.edit', ['contestant' => $contestant->id]) }}">Update</a></li>
                                            <li>
                                                <form id="delete-form-{{ $contestant->id }}" action="{{ route('admin.contestant.destroy', ['contestant' => $contestant->id]) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="dropdown-item" onclick="confirmDelete({{ $contestant->id }})">Delete contestant</button>
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
            $('#contestant-table').DataTable({
                "processing": true,
                "serverSide": false,
                "pageLength": 10,
                "order": [[0, "desc"]],
            });
        });

        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this contestant?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endpush
@endsection
