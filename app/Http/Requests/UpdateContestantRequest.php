<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContestantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:255',
            'barangay'      => 'nullable|string|max:255',
            'no_of_members' => 'nullable|integer',
            'focal_person'  => 'nullable|string|max:255',
            'folk_dance_id' => 'nullable|integer|exists:categories,id',
            'dance_id'      => 'nullable|integer|exists:dances,id',
            'updated_by'    => 'integer|exists:users,id',
        ];
    }
}
