<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contestant extends Model
{
    use HasFactory;

    protected $table='contestants';
    protected $fillable = [
        'name',
        'barangay',
        'no_of_members',
        'focal_person',
        'folk_dance_id',
        'dance_id',
        'added_by',
        'updated_by',
    ];

    public static function getAllContestants()
    {
        return self::all();
    }

    public function category() 
    {
        return $this->belongsTo(Category::class, 'folk_dance_id');
    }

    public function dance() 
    {
        return $this->belongsTo(Dance::class, 'dance_id');
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
