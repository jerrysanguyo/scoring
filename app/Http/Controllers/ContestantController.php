<?php

namespace App\Http\Controllers;

use App\Models\Contestant;
use App\Models\Category;
use App\Models\Dance;
use App\Models\Score;
use App\Http\Requests\StoreContestantRequest;
use App\Http\Requests\UpdateContestantRequest;
use App\DataTables\AllDataTable;
use Illuminate\Support\Facades\Log;

class ContestantController extends Controller
{
    public function index(AllDataTable $dataTable)
    {
        $barangays = [
            'TUKTUKAN', 'CENTRAL_BICUTAN', 'CENTRAL_SIGNAL_VILLAGE', 'FORT_BONIFACIO', 'HAGONOY', 
            'IBAYO-TIPAS', 'LIGID-TIPAS', 'LOWER_BICUTAN', 'MAHARLIKA_VILLAGE', 'NAPINDAN', 
            'NEW_UPPER_BICUTAN', 'NORTH_DAANG_HARI', 'NORTH_SIGNAL_VILLAGE', 'PAG-ASA', 
            'PAMAYANANG_DIEGO_SILANG', 'PINAGSAMA', 'SAN_MIGUEL', 'SANTA_ANA', 'SOUTH_DAANG_HARI', 
            'SOUTH_SIGNAL_VILLAGE', 'TANYAG', 'UPPER_BICUTAN', 'WAWA', 'WESTERN_BICUTAN', 
            'COMEMBO', 'EASTERN_BICUTAN', 'PEMEMBO', 'PITOGO', 'POST_PROPER_NORTHSIDE', 
            'POST_PROPER_SOUTHSIDE', 'RIZAL', 'SOUTH_CEMBO', 'WEST_REMBO',
        ];

        $getAllContestants = Contestant::getAllContestants();
        $getAllCategory = Category::getAllCategories();
        $getAllDance = Dance::getAllDances();

        return $dataTable->render('contestant.index', compact(
            'getAllContestants',
            'getAllCategory',
            'getAllDance',
            'barangays',
        ));
    }

    public function store(StoreContestantRequest $request)
    {
        $validated = $request->validated();
        $validated['added_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try 
        {
            Contestant::create($validated);

            return redirect()->route('admin.contestant.index')
                             ->with('success', 'contestant added successfully!');
        } 
        catch (\Exception $e) 
        {
            Log::error('Failed to store contestant', ['error' => $e->getMessage()]);
            
            return redirect()->route('admin.contestant.index')
                             ->with('error', 'Failed to add contestant. Please try again.');
        }
    }
    
    public function show(Contestant $contestant)
    {
        return view('contestant.show', compact('contestant'));
    }

    public function getContestantScores($id)
    {
        $criteriaScores = $this->calculateAverageScores($id);
        return response()->json($criteriaScores);
    }
    
    private function calculateAverageScores($contestantId)
    {
        $scores = Score::where('contestant_id', $contestantId)->get();
        $criteriaScores = [];
        $overallScore = 0;

        foreach ($scores as $score) {
            if (!isset($criteriaScores[$score->criteria_id])) {
                $criteriaScores[$score->criteria_id] = [
                    'total' => 0,
                    'count' => 0
                ];
            }

            $criteriaScores[$score->criteria_id]['total'] += $score->score;
            $criteriaScores[$score->criteria_id]['count'] += 1;
        }

        foreach ($criteriaScores as $criteriaId => $criteriaScore) {
            $criteriaScores[$criteriaId]['average'] = $criteriaScore['total'] / $criteriaScore['count'];
            $overallScore += $criteriaScores[$criteriaId]['average']; 
        }

        $criteriaScores['overall'] = $overallScore; 

        return $criteriaScores;
    }

    // private function calculateAverageScores($contestantId)
    // {
    //     $scores = Score::where('contestant_id', $contestantId)->get();
    //     $criteriaScores = [];
    //     $overallScore = 0;
    //     $criteriaWeights = [
    //         1 => 0.4,
    //         2 => 0.3,
    //         3 => 0.2,
    //         4 => 0.1
    //     ];

    //     foreach ($scores as $score) {
    //         if (!isset($criteriaScores[$score->criteria_id])) {
    //             $criteriaScores[$score->criteria_id] = [
    //                 'total' => 0,
    //                 'count' => 0
    //             ];
    //         }

    //         $criteriaScores[$score->criteria_id]['total'] += $score->score;
    //         $criteriaScores[$score->criteria_id]['count'] += 1;
    //     }

    //     foreach ($criteriaScores as $criteriaId => $criteriaScore) {
    //         $criteriaScores[$criteriaId]['average'] = $criteriaScore['total'] / $criteriaScore['count'];
    //         $criteriaScores[$criteriaId]['weighted'] = $criteriaScores[$criteriaId]['average'] * $criteriaWeights[$criteriaId];
    //         $overallScore += $criteriaScores[$criteriaId]['weighted'];
    //     }

    //     $criteriaScores['overall'] = $overallScore;

    //     return $criteriaScores;
    // }
    
    public function edit(Contestant $contestant)
    {
        $barangays = [
            'TUKTUKAN', 'CENTRAL_BICUTAN', 'CENTRAL_SIGNAL_VILLAGE', 'FORT_BONIFACIO', 'HAGONOY', 
            'IBAYO-TIPAS', 'LIGID-TIPAS', 'LOWER_BICUTAN', 'MAHARLIKA_VILLAGE', 'NAPINDAN', 
            'NEW_UPPER_BICUTAN', 'NORTH_DAANG_HARI', 'NORTH_SIGNAL_VILLAGE', 'PAG-ASA', 
            'PAMAYANANG_DIEGO_SILANG', 'PINAGSAMA', 'SAN_MIGUEL', 'SANTA_ANA', 'SOUTH_DAANG_HARI', 
            'SOUTH_SIGNAL_VILLAGE', 'TANYAG', 'UPPER_BICUTAN', 'WAWA', 'WESTERN_BICUTAN', 
            'COMEMBO', 'EASTERN_BICUTAN', 'PEMEMBO', 'PITOGO', 'POST_PROPER_NORTHSIDE', 
            'POST_PROPER_SOUTHSIDE', 'RIZAL', 'SOUTH_CEMBO', 'WEST_REMBO'
        ];
        $getAllCategory = Category::getAllCategories();
        $getAllDance = Dance::getAllDances();

        return view('contestant.edit', compact(
            'contestant', 
            'barangays',
            'getAllCategory',
            'getAllDance',
        ));
    }
    
    public function update(UpdateContestantRequest $request, Contestant $contestant)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        try 
        {
            $contestant->update($validated);

            return redirect()->route('admin.contestant.edit', $contestant)
                             ->with('success', 'contestant updated successfully!');
        } 
        catch (\Exception $e) 
        {
            Log::error('Failed to update contestant', ['error' => $e->getMessage()]);
            
            return redirect()->route('admin.contestant.edit', $contestant)
                             ->with('error', 'Failed to update contestant. Please try again.');
        }
    }
    
    public function destroy(Contestant $contestant)
    {
        try
        {
            $contestant->delete();
        
            return redirect()->route('admin.contestant.index')
                             ->with('success', 'contestant deleted successfully!');
        }
        catch (\Exception $e)
        {
            Log::error('Failed to delete contestant', ['error' => $e->getMessage()]);
            
            return redirect()->route('admin.contestant.index')
                             ->with('error', 'Failed to delete contestant. Please try again.');
        }
    }
}
