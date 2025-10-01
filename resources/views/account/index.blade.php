@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-1">
            <span class="fs-3">Folk dance account</span>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                        Add account
                </button>
                @include('account.create')
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

                    <table class="table table-striped" id="account-table">
                        <thead>
                            <tr>
                                <th>Account name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listOfAccount as $account)
                            <tr>
                                <td>{{ $account->name }}</td>
                                <td>{{ $account->email }}</td>
                                <td>{{ $account->type }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('admin.account.edit', ['account' => $account->id]) }}">Update</a></li>
                                            <li>
                                                <form id="delete-form-{{ $account->id }}" action="{{ route('admin.account.destroy', ['account' => $account->id]) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="dropdown-item" onclick="confirmDelete({{ $account->id }})">Delete account</button>
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
            $('#account-table').DataTable({
                "processing": true,
                "serverSide": false,
                "pageLength": 10,
                "order": [[0, "desc"]],
            });
        });

        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this account?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endpush
@endsection
