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
                {{ $criteria->percentage }}%
            </td>
            <td>
                <form action="{{ isset($existingScores[$criteria->id]) 
                                                ? (Auth::user()->type === 'admin' 
                                                    ? route('admin.score.update', ['score' => $existingScores[$criteria->id]->id]) 
                                                    : route('judge.score.update', ['score' => $existingScores[$criteria->id]->id])) 
                                                : (Auth::user()->type === 'admin' 
                                                    ? route('admin.score.store') 
                                                    : route('judge.score.store')) 
                                            }}" method="POST">
                    @csrf
                    @if(isset($existingScores[$criteria->id]))
                    @method('PUT')
                    <input type="hidden" name="score_id" value="{{ $existingScores[$criteria->id]->id }}">
                    @endif
                    <input type="hidden" name="criteria_id" value="{{ $criteria->id }}">
                    <input type="hidden" name="contestant_id" value="{{ $contestant->id }}">
                    <input type="number" step="0.01" name="score" id="score" class="form-control"
                        value="{{ $existingScores[$criteria->id]->score ?? '' }}" max="{{ $criteria->percentage }}"
                        min="0">
            </td>
            <td>
                @if(!isset($existingScores[$criteria->id]))
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