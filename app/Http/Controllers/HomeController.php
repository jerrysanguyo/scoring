<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contestant;
use App\Models\Score;
use App\Models\TalentScore;
use App\Models\GownScore;
use App\Models\Criteria;
use App\DataTables\AllDataTable;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(AllDataTable $dataTable)
    {
        $criteria = Criteria::getAllCriteria();
        $getAllContestants             = Contestant::getAllContestants();
        $criteriaPercentages           = Criteria::getPercentages();

        $contestantsWithScores = $getAllContestants->map(function ($contestant) use (
            $criteriaPercentages,
        ) {
            $scores         = Score::getGroupedScoresByCriteria($contestant->id);
            $criteriaScores = [];
            $overallScore   = 0;

            foreach ($scores as $score) {
                $criteriaId    = $score->criteria_id;
                $totalScore    = $score->total;
                $judgeCount    = $score->count > 0 ? $score->count : 1;
                $aveTotalScore = $totalScore / $judgeCount;
                $averageScore  = $totalScore / $judgeCount;

                $percentage      = $criteriaPercentages[$criteriaId] ?? 0;
                $weightedAverage = ($averageScore / $percentage) * $percentage;
                
                $scorers = Score::where('contestant_id', $contestant->id)
                    ->where('criteria_id', $criteriaId)
                    ->with('scoredBy')
                    ->get()
                    ->pluck('scoredBy.name')
                    ->filter()
                    ->toArray();

                $criteriaScores[$criteriaId] = [
                    'total'      => $aveTotalScore,
                    'count'      => $judgeCount,
                    'average'    => $averageScore,
                    'weighted'   => $weightedAverage,
                    'percentage' => $percentage,
                    'scorers'    => $scorers,
                ];

                $overallScore += $weightedAverage;
            }

            $contestant->criteria_scores = $criteriaScores;
            $contestant->overall_score   = $overallScore;

            return $contestant;
        });

        return $dataTable->render('home', compact('contestantsWithScores', 'criteria'));
    }
}
