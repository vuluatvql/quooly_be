<?php

namespace App\Http\Requests;

use App\Enums\ContactStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $id = $this->contact;
        return [
            'status' => [
                'required',
                Rule::in([ContactStatus::SUPPORTED, ContactStatus::NOT_SUPPORT])
                ]
        ];
    }
}
