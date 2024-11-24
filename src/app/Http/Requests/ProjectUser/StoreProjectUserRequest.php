<?php

namespace App\Http\Requests\ProjectUser;

use App\Repositories\ProjectUser\StoreProjectUserParams;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectUserRequest extends FormRequest
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
            'user_email' => ['required', 'string', 'email'],
        ];
    }

    /**
     * パラメータをStoreProjectUserParamsに格納
     *
     * @return StoreProjectUserParams
     */
    public function getParams(): StoreProjectUserParams
    {
        return new StoreProjectUserParams(
            projectId: $this->route('projectId'),
            userEmail: $this->input('user_email'),
        );
    }
}
