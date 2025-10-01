<table class="table table-striped">
    <thead>
        <tr>
            <th>Criteria</th>
            <th>Score</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($listOfTalentCriteria as $talentCriteria)
        <tr>
            <td>
                {{ $talentCriteria->name }}
                {{ $talentCriteria->percentage }}%
            </td>
            <td>
                <form action="{{ isset($existingTalentScores[$talentCriteria->id]) 
                                                ? (Auth::user()->type === 'admin' 
                                                    ? route('admin.talentScore.update', ['talentScore' => $existingTalentScores[$talentCriteria->id]->id]) 
                                                    : route('judge.talentScore.update', ['talentScore' => $existingTalentScores[$talentCriteria->id]->id])) 
                                                : (Auth::user()->type === 'admin' 
                                                    ? route('admin.talentScore.store') 
                                                    : route('judge.talentScore.store')) 
                                            }}" method="POST">
                    @csrf
                    @if(isset($existingTalentScores[$talentCriteria->id]))
                    @method('PUT')
                    <input type="hidden" name="score_id" value="{{ $existingTalentScores[$talentCriteria->id]->id }}">
                    @endif
                    <input type="hidden" name="criteria_id" value="{{ $talentCriteria->id }}">
                    <input type="hidden" name="contestant_id" value="{{ $contestant->id }}">
                    <input type="number" step="0.01" name="score" id="score" class="form-control"
                        value="{{ $existingTalentScores[$talentCriteria->id]->score ?? '' }}" max="{{ $talentCriteria->percentage }}"
                        min="0">
            </td>
            <td>
                @if(!isset($existingTalentScores[$talentCriteria->id]))
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