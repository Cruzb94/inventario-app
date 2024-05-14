<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TallerRequest extends FormRequest
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
			'nombre' => 'required',
			'referencia' => 'required',
			'descripcion' => 'required',
			'fecha' => 'required',
			'cantidad' => 'required',
			'valor_unidad' => 'required',
			'valor_total' => 'required',
			'observaciones' => 'required',
			'reprocesos' => 'required',
        ];
    }
}
