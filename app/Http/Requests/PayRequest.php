<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'identification' => 'required|max:20',
            'cell_phone' => 'required|max:15',
            'payment_money' => 'required'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'identification.required'=> 'El numero de identificación es obligatorio.',
            'identification.max'=> 'El numero de identificación no debe tener mas de 20 caracteres.',
            'cell_phone.required'=> 'El numero de celular es obligatorio.',
            'cell_phone.max'=> 'El numero de celular no debe tener mas de 15 caracteres.',
            'payment_money.required'=> 'El dinero del pago es obligatorio.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'cod_error' => 00,
            'message_error' => 'Errores de validacion',
            'data' => $validator->errors()
        ]));
    }
}