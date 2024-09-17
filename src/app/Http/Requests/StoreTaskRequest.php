<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type_id' => ['int', 'required'],
            'title' => ['string', 'required', 'max:255'],
            'body' => ['string', 'nullable'],
            'state_id' => ['int', 'required'],
            'manager' => ['string', 'required'],
            'priority_id' => ['int', 'required'],
            'version_id' => ['int', 'nullable'],
            'start_date' => ['string', 'nullable'],
            'end_date' => ['string', 'nullable'],
        ];
    }
}
