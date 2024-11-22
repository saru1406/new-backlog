<?php

namespace App\Http\Requests\Priority;

use App\Repositories\Priority\StorePriorityParams;
use Illuminate\Foundation\Http\FormRequest;

class StorePriorityRequest extends FormRequest
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
            'priority_name' => ['string', 'required'],
        ];
    }

    /**
     * パラメータをStorePriorityParamsに格納
     *
     * @return StorePriorityParams
     */
    public function getParams(): StorePriorityParams
    {
        return new StorePriorityParams(
            projectId: $this->route('projectId'),
            priorityName: $this->input('priority_name'),
        );
    }
}
