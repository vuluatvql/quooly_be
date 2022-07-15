<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $id = $this->user;
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'first_name_furigana' => [
                'required',
                'regex:/^[ぁ-ん]+$/'
            ],
            'last_name_furigana' => [
                'required',
                'regex:/^[ぁ-ん]+$/'
            ],
            'postcode' => 'required|max:10',
            'prefecture_id' => 'required',
            'city' => 'required',
            'company_industry_type' => 'required',
            'jobs_type' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'birthday' => 'required',
            'rent_income' => 'required',
            'annual_income' => 'required',
            'user_income' => 'required',
            'email' => [
                'required',
                'max:255',
                Rule::unique('user')->whereNull('deleted_at')->where(function($q) use ($id) {
                    if ($id) {
                        $q->where('id', '<>', $id);
                    }
                })
            ],
            'password' => [
                'nullable',
                'max:15',
                'min:8',
                'regex:/^[A-Za-z0-9]*$/',
                'same:password_confirmation'
            ],
            'password_confirmation' => 'nullable'
        ];
    }
}
