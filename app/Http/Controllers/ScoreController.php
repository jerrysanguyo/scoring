<?php

namespace App\Http\Controllers;

use App\Services\ScoreService;
use App\Models\Criteria;
use App\Models\TalentCriteria;
use App\Models\GownCriteria;
use App\Models\Score;
use App\Models\TalentScore;
use App\Models\GownScore;
use App\Models\Contestant;
use Illuminate\Http\Request;
use App\Http\Requests\StoreScoreRequest;
use App\Http\Requests\UpdateScoreRequest;
use App\Http\Requests\TalentScoreRequest;
use App\Http\Requests\GownScoreRequest;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    protected $scoreService;

    public function __construct(ScoreService $scoreService)
    {
        $this->scoreService = $scoreService;
    }

    public function vote(Request $request, Contestant $contestant)
    {
        $listOfTalentCriteria = TalentCriteria::getAllTalentCriteria();
        $listOfGownCriteria = GownCriteria::getAllGownCriteria();
        $listOfCriteria = Criteria::getAllCriteria();    
        $existingScores = $this->scoreService->getExistingScores($contestant->id, auth()->id());
        $existingTalentScores = $this->scoreService->getExistingTalentScore($contestant->id, auth()->id());
        $existingGownScores = $this->scoreService->getExistingGownScore($contestant->id, auth()->id());

        return view('score.index', compact(
            'listOfCriteria',
            'listOfTalentCriteria',
            'listOfGownCriteria',
            'contestant',
            'existingScores',
            'existingTalentScores',
            'existingGownScores',
        ));
    }

    public function talentStore(TalentScoreRequest $request)
    {
        $validated = $request->validated();
        $validated['scored_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        $this->scoreService->talentStore($validated);

        return redirect()
            ->route(Auth::user()->type . '.score.vote', $validated['contestant_id'])
            ->with('success', "Talent category score added successfullly!");
    }

    public function talentUpdate(UpdateScoreRequest $request, TalentScore $talentScore)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        $result = $this->scoreService->updateTalentScore($validated, $talentScore);

        $route = auth()->user()->type === 'judge' ? 'judge.score.vote' : 'admin.score.vote';
        
        return redirect()->route($route, $validated['contestant_id'])
        ->with($result['success'] ? 'success' : 'error', $result['success'] ? 'Score updated successfully!' : 'Failed to update score. Please try again.');    
    }

    public function gownStore(GownScoreRequest $request)
    {
        $validated = $request->validated();
        $validated['scored_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        $this->scoreService->gownStore($validated);

        return redirect()
            ->route(Auth::user()->type . '.score.vote', $validated['contestant_id'])
            ->with('success', "Gown category score added successfullly!");
    }

    public function gownUpdate(UpdateScoreRequest $request, GownScore $gownScore)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        $result = $this->scoreService->updateGownScore($validated, $gownScore);

        $route = auth()->user()->type === 'judge' ? 'judge.score.vote' : 'admin.score.vote';
        
        return redirect()->route($route, $validated['contestant_id'])
        ->with($result['success'] ? 'success' : 'error', $result['success'] ? 'Score updated successfully!' : 'Failed to update score. Please try again.');    
    }
    
    public function store(StoreScoreRequest $request)
    {
        $validated = $request->validated();
        $validated['scored_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        $result = $this->scoreService->storeScore($validated);

        $route = auth()->user()->type === 'judge' ? 'judge.score.vote' : 'admin.score.vote';
        
        return redirect()->route($route, $validated['contestant_id'])
        ->with($result['success'] ? 'success' : 'error', $result['success'] ? 'Score added successfully!' : 'Failed to add score. Please try again.');    
    }

    public function update(UpdateScoreRequest $request, Score $score)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        $result = $this->scoreService->updateScore($validated, $score);

        $route = auth()->user()->type === 'judge' ? 'judge.score.vote' : 'admin.score.vote';
        
        return redirect()->route($route, $validated['contestant_id'])
        ->with($result['success'] ? 'success' : 'error', $result['success'] ? 'Score updated successfully!' : 'Failed to update score. Please try again.');    
    }
}
