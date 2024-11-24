<?php

namespace App\Http\Requests\Type;

use App\Repositories\Type\StoreTypeParams;
use Illuminate\Foundation\Http\FormRequest;

class StoreTypeRequest extends FormRequest
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
     * パラメータをStoreTypeParamsに格納
     *
     * @return StoreTypeParams
     */
    public function getParams(): StoreTypeParams
    {
        return new StoreTypeParams(
            projectId: $this->route('projectId'),
            typeName: $this->input('type_name'),
        );
    }
}
