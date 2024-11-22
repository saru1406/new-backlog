<?php

namespace App\Http\Requests\User;

use App\Repositories\user\StoreUserParams;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'type_name' => ['string', 'required'],
        ];
    }

    /**
     * パラメータをStoreUserParamsに格納
     *
     * @return StoreUserParams
     */
    public function getParams(): StoreUserParams
    {
        return new StoreUserParams(
            projectId: $this->route('projectId'),
            userId: $this->input('user_id'),
        );
    }
}
