<?php

namespace App\Http\Requests\ChildTask;

use App\Repositories\ChildTask\StoreChildTaskParams;
use Illuminate\Foundation\Http\FormRequest;

class StoreChildTaskRequest extends FormRequest
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
     * @return StoreChildTaskParams
     */
    public function getParams(): StoreChildTaskParams
    {
        return new StoreChildTaskParams(
            project_id: $this->route('projectId'),
            task_id: $this->route('taskId'),
            type_id: $this->input('type_id'),
            state_id: $this->input('state_id'),
            manager_id: $this->input('manager'),
            priority_id: $this->input('priority_id'),
            version_id: $this->input('version_id'),
            title: $this->input('title'),
            body: $this->input('body'),
            start_date: $this->input('start_date'),
            end_date: $this->input('end_date'),
        );
    }
}
