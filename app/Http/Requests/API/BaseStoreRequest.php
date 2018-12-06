<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    protected function failedValidation(Validator $validator) 
    {       
        $rules = $this->rules();
        $errors = [];

        foreach ($rules as $field => $rule) {
            $error = $validator->errors()->first($field);
            if (strlen($error)) {
                $errors[$field] = $error;
            }
        }
        
        throw new HttpResponseException(
            response()->json([
                'errors' => $errors,
            ], 422)
        ); 
    }
}
