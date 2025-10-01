<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentCriteria extends Model
{
    use HasFactory;

    protected $table='talent_criterias';
    protected $fillable = [
        'name',
        'percentage',
        'added_by',
        'updated_by',
    ];

    public static function getAllTalentCriteria()
    {
        return self::all();
    }
    
    public static function getTalentPercentages()
    {
        return self::pluck('percentage', 'id');
    }

    public function createdBy() 
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function updatedBy() 
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
