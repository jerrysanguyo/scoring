<?php

namespace App\Services;

use App\Models\Score;
use App\Models\TalentScore;
use App\Models\GownScore;
use Illuminate\Support\Facades\Log;

class ScoreService
{
    public function getExistingScores($contestantId, $scoredBy)
    {
        return Score::where('contestant_id', $contestantId)
                    ->where('scored_by', $scoredBy)
                    ->get()
                    ->keyBy('criteria_id');
    }

    public function getExistingTalentScore($contestantId, $scoreBy)
    {
        return TalentScore::where('contestant_id', $contestantId)
                    ->where('scored_by', $scoreBy)
                    ->get()
                    ->keyBy('criteria_id');
    }

    public function getExistingGownScore($contestantId, $scoreBy)
    {
        return GownScore::where('contestant_id', $contestantId)
                    ->where('scored_by', $scoreBy)
                    ->get()
                    ->keyBy('criteria_id');
    }

    public function talentStore(array $data)
    {
        try {
            TalentScore::create($data);
            return ['success' => true, 'message' => 'Talent score added successfully!'];
        } catch (\Exception $e) {
            Log::error('Failed to store talent score', ['error' => $e->getMessage()]);
            return ['success' => false, 'message' => 'Failed to add talent score. Please try again.'];
        }
    }

    public function updateTalentScore(array $data, TalentScore $talentScore): array
    {
        try
        {
            $talentScore->update($data);
            return ['score' => $talentScore, 'success' => true, 'message' => 'Talent score updated successfully!'];
        } catch (\Exception $e) {
            Log::error('Failed to store talent score', ['error' => $e->getMessage()]);
            return ['success' => false, 'message' => 'Failed to update talent score. Please try again.'];
        }
    }

    public function gownStore(array $data)
    {
        try {
            GownScore::create($data);
            return ['success' => true, 'message' => 'Gown score added successfully!'];
        } catch (\Exception $e) {
            Log::error('Failed to store gown score', ['error' => $e->getMessage()]);
            return ['success' => false, 'message' => 'Failed to add gown score. Please try again.'];
        }
    }
    
    public function updateGownScore(array $data, GownScore $gownScore): array
    {
        try
        {
            $gownScore->update($data);
            return ['score' => $gownScore, 'success' => true, 'message' => 'Gown score updated successfully!'];
        } catch (\Exception $e) {
            Log::error('Failed to store gown score', ['error' => $e->getMessage()]);
            return ['success' => false, 'message' => 'Failed to update gown score. Please try again.'];
        }
    }

    public function storeScore(array $data)
    {
        try {
            Score::create($data);
            return ['success' => true, 'message' => 'Score added successfully!'];
        } catch (\Exception $e) {
            Log::error('Failed to store score', ['error' => $e->getMessage()]);
            return ['success' => false, 'message' => 'Failed to add score. Please try again.'];
        }
    }

    public function updateScore(array $data, Score $score): array
    {
        try
        {
            $score->update($data);
            return ['score' => $score, 'success' => true, 'message' => 'Score updated successfully!'];
        } catch (\Exception $e) {
            Log::error('Failed to store score', ['error' => $e->getMessage()]);
            return ['success' => false, 'message' => 'Failed to update score. Please try again.'];
        }
    }
}
