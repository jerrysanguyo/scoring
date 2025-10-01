<!-- resources/views/contestant/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="fs-3 text-dark fw-semibold"><i class="bi bi-people-fill me-2"></i>Contestant</span>
            </div>

            <div class="card shadow-sm rounded-3">
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i> Please fix the following errors:
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="contestant-table">
                            <thead class="table-light text-uppercase small">
                                <tr>
                                    <th>Contestant Name</th>
                                    @foreach ($criteria as $c)
                                    <th>{{ $c->name  }}</th>
                                    @endforeach
                                    <th class="text-center">Overall score</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contestantsWithScores as $contestant)
                                <tr>
                                    <td class="ps-3">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $contestant->photo_url ?? asset('image/default.webp') }}"
                                                alt="Avatar" class="rounded-circle me-2"
                                                style="width:36px; height:36px; object-fit:cover;">
                                            <span class="fw-medium">{{ $contestant->name }}</span>
                                        </div>
                                    </td>

                                    @foreach($criteria as $c)
                                    @php
                                    $scoreData = $contestant->criteria_scores[$c->id] ?? ['weighted' => 0];
                                    @endphp
                                    <td class="text-center">
                                        <span class="badge bg-info text-dark px-2 py-1">
                                            {{ number_format($scoreData['weighted'], 2) }}
                                        </span>
                                    </td>
                                    @endforeach

                                    <td class="text-center">
                                        <span class="badge bg-primary text-white px-2 py-1">
                                            {{ number_format($contestant->overall_score, 2) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                @if (Auth::user()->type === 'admin' || Auth::user()->type === 'judge')
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route(Auth::user()->type . '.score.vote', ['contestant' => $contestant->id]) }}">
                                                        <i class="bi bi-pencil-square me-1"></i> Score
                                                    </a>
                                                </li>
                                                @endif
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
</div>

@push('scripts')
<script>
$(function() {
    $('#contestant-table').DataTable({
        processing: true,
        pageLength: 10,
        order: [
            [0, 'asc']
        ],
        columnDefs: [{
                orderable: false,
                targets: [4]
            },
            {
                className: 'text-center',
                targets: [1, 2, 3, 4]
            }
        ],
        language: {
            search: "Filter:",
            searchPlaceholder: "Quick search..."
        }
    });
});
</script>
@endpush
@endsection