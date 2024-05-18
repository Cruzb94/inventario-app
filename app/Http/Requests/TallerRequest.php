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
        $rules = [
            'nombre' => 'required',
            'fecha' => 'required',
            'valor_total' => 'required',
            'observaciones' => 'required',
            'reprocesos' => 'required',
        ];
    
        // Itera sobre los campos y agrega reglas de validación requeridas para cada conjunto de datos
        foreach ($this->all() as $key => $value) {
            // Verifica si el campo es de la forma referenciaX, descripcionX, cantidadX, valor_unidadX
            if (preg_match('/^(referencia|descripcion|cantidad|valor_unidad)\d+$/', $key)) {
                $rules[$key] = 'required';
            }
        }
    
        return $rules;
}
}
