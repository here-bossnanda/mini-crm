<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompaniesRequest extends FormRequest
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
        'name' => 'required|string',
        'email' => 'email',
        'logo' => 'dimensions:max_width=100,max_height=100|mimes:jpg,jpeg,png,svg',
        ];
        if (request()->isMethod('post')) {
            $rules['name'] = 'required|string';
        }
        if (request()->isMethod('patch')) {
            $rules['name'] = 'string';
        }
        
        return $rules;
    }

    
    }
