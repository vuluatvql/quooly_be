<?php

namespace App\Http\Requests;

use App\Enums\bukkenType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ViewHistoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'bukken_id' => [
                'required',
                Rule::in([
                    bukkenType::APARTMENT, bukkenType::BUILDING_APARTMENT,
                    bukkenType::DETACHED_HOURSE, bukkenType::LAND, bukkenType::SELECTIONAL_APARTMENT
                ])
            ]
        ];
    }
}
