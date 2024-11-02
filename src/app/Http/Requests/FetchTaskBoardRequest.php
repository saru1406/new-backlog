<?php

namespace App\Http\Requests;

use App\Repositories\Task\FetchTaskBoardParams;
use Illuminate\Foundation\Http\FormRequest;

class FetchTaskBoardRequest extends FormRequest
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
            'type_id' => ['integer', 'nullable'],
            'state_id' => ['integer', 'nullable'],
            'manager' => ['string', 'nullable'],
            'priority_id' => ['integer', 'nullable'],
            'version_id' => ['integer', 'nullable'],
        ];
    }

    /**
     * パラメータをFetchTaskBoardParamsに格納
     *
     * @return FetchTaskBoardParams
     */
    public function getParams(): FetchTaskBoardParams
    {
        return new FetchTaskBoardParams(
            project_id: $this->route('projectId'),
            type_id: $this->query('type_id'),
            state_id: $this->query('state_id'),
            manager: $this->query('manager'),
            priority_id: $this->query('priority_id'),
            version_id: $this->query('version_id'),
        );
    }
}
