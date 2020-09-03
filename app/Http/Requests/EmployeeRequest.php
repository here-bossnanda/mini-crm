<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'company_id' => 'required|integer',
        'email' => 'email|unique:employees',
        ];
        if (request()->isMethod('post')) {
            $rules['first_name'] = 'required|string';
            $rules['last_name'] = 'required|string';
            $rules['company_id'] = 'required|integer';
            $rules['email'] = 'email|unique:employees';
        }
        if (request()->isMethod('patch')) {
            $rules['first_name'] = 'string';
            $rules['last_name'] = 'string';
            $rules['company_id'] = 'integer';
            $rules['email'] = 'email';
        }
        return $rules;
    }
}
