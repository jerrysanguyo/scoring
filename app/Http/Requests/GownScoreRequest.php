<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GownScoreRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'contestant_id' => 'integer|exists:contestants,id',
            'criteria_id'   => 'integer|exists:gown_criterias,id',
            'score'         => 'numeric|required',
        ];
    }
}
