<table class="table table-striped">
    <thead>
        <tr>
            <th>Criteria</th>
            <th>Score</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($listOfGownCriteria as $gownCriteria)
        <tr>
            <td>
                {{ $gownCriteria->name }}
                {{ $gownCriteria->percentage }}%
            </td>
            <td>
                <form action="{{ isset($existingGownScores[$gownCriteria->id]) 
                                                ? (Auth::user()->type === 'admin' 
                                                    ? route('admin.gownScore.update', ['gownScore' => $existingGownScores[$gownCriteria->id]->id]) 
                                                    : route('judge.gownScore.update', ['gownScore' => $existingGownScores[$gownCriteria->id]->id])) 
                                                : (Auth::user()->type === 'admin' 
                                                    ? route('admin.gownScore.store') 
                                                    : route('judge.gownScore.store')) 
                                            }}" method="POST">
                    @csrf
                    @if(isset($existingGownScores[$gownCriteria->id]))
                    @method('PUT')
                    <input type="hidden" name="score_id" value="{{ $existingGownScores[$gownCriteria->id]->id }}">
                    @endif
                    <input type="hidden" name="criteria_id" value="{{ $gownCriteria->id }}">
                    <input type="hidden" name="contestant_id" value="{{ $contestant->id }}">
                    <input type="number" step="0.01" name="score" id="score" class="form-control"
                        value="{{ $existingGownScores[$gownCriteria->id]->score ?? '' }}" max="{{ $gownCriteria->percentage }}"
                        min="0">
            </td>
            <td>
                @if(!isset($existingGownScores[$gownCriteria->id]))
                <button type="submit" class="btn btn-primary">Submit</button>
                @else
                <input type="submit" value="Update" class="btn btn-primary">
                @endif
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>