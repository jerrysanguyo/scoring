<?php

namespace App\Services;

use App\Models\TalentCriteria;
use Illuminate\Support\Facades\Auth;

class TalentCriteriaService
{
    public function store(array $data): TalentCriteria
    {
        return TalentCriteria::create([
            'name' => $data['name'],
            'percentage' => $data['percentage'],
            'added_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
    }

    public function update($talentCriterion, array $data): void
    {
        $talentCriterion->update([
            'name' => $data['name'],
            'percentage' => $data['percentage'],
            'updated_by' => Auth::user()->id,
        ]);
    }

    public function destroy($talentCriterion): void
    {
        $talentCriterion->delete();
    }
}