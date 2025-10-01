<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $table='criterias';
    protected $fillable = [
        'name',
        'percentage',
        'added_by',
        'updated_by',
    ];

    public static function getAllCriteria()
    {
        return self::all();
    }
    
    public static function getPercentages()
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
