<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubmissionValidation extends FormRequest
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
        return [
            'language_argument' => [
                'required',
                Rule::exists('languages', 'argument')->where(function ($query) {
                    $query->where('is_archived', 0);
                }),
            ],
            'time_limit'        => 'required|integer',
            'memory_limit'      => 'required|integer',
            'source_code'       => 'required',
            'checker_type'      => 'required|in:default,custom',
            'default_checker'   => 'required_if:checker_type,default',
            'custom_checker'    => 'required_if:checker_type,custom',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
