<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'project_id' => 'required',
            'name' => 'required|max:100',
            'priority' => 'required'

        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = response()->json($validator->errors(), 422);

        throw new HttpResponseException($errors);
    }
}
