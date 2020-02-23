<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommonLogTriggerRequest extends FormRequest
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
            'project' => 'required|string',
        	'log' => 'required|array',
        	'log.*level' => 'required',
        	'log.*message' => 'required|string',
        	'log.*context' => 'array'
        ];
    }
}
