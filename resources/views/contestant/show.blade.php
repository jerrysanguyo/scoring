@extends('layouts.auth.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-3 text-white">Scores:</span>
                <a href="{{ route(Auth::user()->type . '.home') }}" class="text-decoration-none">
                    <button class="btn btn-primary">
                        Back
                    </button>
                </a>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card border shadow">
                        <div class="card-body">
                            <span class="fs-5">Criteria #1:</span>
                            <div class="row justify-content-center">
                                <span class="fs-1" id="criteria-1">N/A</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card border shadow">
                        <div class="card-body">
                            <span class="fs-5">Criteria #2:</span>
                            <div class="row justify-content-center">
                                <span class="fs-1" id="criteria-2">N/A</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card border shadow">
                        <div class="card-body">
                            <span class="fs-5">Criteria #3:</span>
                            <div class="row justify-content-center">
                                <span class="fs-1" id="criteria-3">N/A</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card border shadow">
                        <div class="card-body">
                            <span class="fs-5">Criteria #4:</span>
                            <div class="row justify-content-center">
                                <span class="fs-1" id="criteria-4">N/A</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-lg-5">
                    <div class="card border shadow">
                        <div class="card-body">
                            <span class="fs-5">Overall score:</span>
                            <div class="row justify-content-center">
                                <span class="fs-1" id="overall">N/A</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
$(document).ready(function() {
    const contestantId = {
        {
            $contestant - > id
        }
    };
    const userType = '{{ Auth::user()->type }}';
    let url;

    if (userType === 'user') {
        url = `/user/contestant-scores/${contestantId}`;
    } else if (userType === 'judge') {
        url = `/judge/contestant-scores/${contestantId}`;
    } else {
        url = `/admin/contestant-scores/${contestantId}`;
    }

    function fetchScores() {
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                $('#criteria-1').text(data[1]?.average ? data[1].average.toFixed(2) : 'N/A');
                $('#criteria-2').text(data[2]?.average ? data[2].average.toFixed(2) : 'N/A');
                $('#criteria-3').text(data[3]?.average ? data[3].average.toFixed(2) : 'N/A');
                $('#criteria-4').text(data[4]?.average ? data[4].average.toFixed(2) : 'N/A');
                $('#overall').text(data.overall ? data.overall.toFixed(2) : 'N/A');
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    fetchScores();
    setInterval(fetchScores, 1000); // Update every 1 seconds
});
</script>
@endpush
@endsection