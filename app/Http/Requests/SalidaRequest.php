<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalidaRequest extends FormRequest
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
        return
        [
			'referencia' => 'required',
			'descripcion' => 'required',
			'fecha' => 'required',
			'cantidad' => 'required',
			'guia' => 'required',
			'valor' => 'required',
			'estatus' => 'required',
        ];
    }
}
