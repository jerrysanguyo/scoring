<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GownScore extends Model
{
    use HasFactory;

    protected $table='gown_scores';
    protected $fillable=[
        'contestant_id',
        'criteria_id',
        'scored_by',
        'score',
        'updated_by',
    ];

    public static function getAllScores()
    {
        return self::all();
    }
    public static function getGroupedScoresByGownCriteria(int $contestantId)
    {
        return self::selectRaw('criteria_id, SUM(score) as total, COUNT(score) as count')
            ->where('contestant_id', $contestantId)
            ->groupBy('criteria_id')
            ->get();
    }

    public function scoredBy()
    {
        return $this->belongsTo(User::class, 'scored_by');
    }

    public function contestantId()
    {
        return $this->belongsTo(Contestant::class, 'contestant_id');
    }

    public function criteriaId()
    {
        return $this->belongsTo(GownCriteria::class, 'criteria_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
