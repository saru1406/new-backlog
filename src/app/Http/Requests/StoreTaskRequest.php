<?php

namespace App\Http\Requests;

use App\Repositories\Task\StoreTaskParams;
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

    /**
     * ParamsをStoreTaskParamsに格納
     *
     * @return StoreTaskParams
     */
    public function getParams(): StoreTaskParams
    {
        return new StoreTaskParams(
            project_id: $this->route('projectId'),
            type_id: $this->input('type_id'),
            state_id: $this->input('state_id'),
            manager: $this->input('manager'),
            priority_id: $this->input('priority_id'),
            version_id: $this->input('version_id'),
            title: $this->input('title'),
            body: $this->input('body'),
            start_date: $this->input('start_date'),
            end_date: $this->input('end_date'),
        );
    }
}
