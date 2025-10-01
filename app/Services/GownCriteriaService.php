<?php

namespace App\Services;

use App\Models\GownCriteria;
use Illuminate\Support\Facades\Auth;

class GownCriteriaService
{
    public function store(array $data): GownCriteria
    {
        return GownCriteria::create([
            'name' => $data['name'],
            'percentage' => $data['percentage'],
            'added_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
    }

    public function update($gownCriterion, array $data): void
    {
        $gownCriterion->update([
            'name' => $data['name'],
            'percentage' => $data['percentage'],
            'updated_by' => Auth::user()->id,
        ]);
    }

    public function destroy($gownCriterion): void
    {
        $gownCriterion->delete();
    }
}