<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\MailNoti;
use App\Enums\IndustryType;
use App\Enums\JobType;
use Carbon\Carbon;
use App\Models\Prefecture;

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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'first_name_furigana' => 'required|max:255|regex:/^[ぁ-ん]+$/',
            'last_name_furigana' => 'required|max:255|regex:/^[ぁ-ん]+$/',
            'birthday' => 'required|date_format:Y/m/d|before_or_equal:' . Carbon::now()->format('Y/m/d'),
            'password' => 'nullable|max:16|min:8|regex:/^[A-Za-z0-9]*$/',
            'phone_number' => [
                'required',
                'regex:/^(0(\d-\d{4}-\d{4}))|(0(\d{3}-\d{2}-\d{4}))|((070|080|090|050)(-\d{4}-\d{4}))|(0(\d{2}-\d{3}-\d{4}))+$/'
            ],
            'postcode' => 'required|max:10',
            'prefecture_id' => [
                'required',
                Rule::in(Prefecture::pluck('id'))
            ],
            'city' => 'required|max:255',
            'address' => 'required|max:255',
            'jobs_type' => [
                'required',
                'integer',
                Rule::in(JobType::getValues())
            ],
            'company_industry_type' => [
                'required',
                'integer',
                Rule::in(IndustryType::getValues())
            ],
            'rent_income' => 'required|integer',
            'annual_income' => 'required|integer',
            'user_income' => 'required|integer',
            'property_building' => 'required|integer',
            'property_division' => 'required|integer',
            'property_kodate_chintai' => 'required|integer',
            'email' => [
                'required',
                'max:255',
                Rule::unique('users')->whereNull('deleted_at')->where(function($q) use ($id) {
                    if ($id) {
                        $q->where('id', '<>', $id);
                    }
                }),
                'email'
            ],
        ];
    }
}
