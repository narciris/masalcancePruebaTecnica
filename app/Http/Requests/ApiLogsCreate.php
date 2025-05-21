<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiLogsCreate extends FormRequest
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
            'method' => 'required',
            'data' => 'required',
        ];
    }

    public function messages(){
        return [
            'method.required' => 'El metodo es requerido',
            'data.required' => 'La data es requerida',
        ];
    }
}
