<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BackgroundUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'background' => 'required|file|mimes:webp|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'background.mimes' => 'The background must be a WEBP image.',
        ];
    }
}
