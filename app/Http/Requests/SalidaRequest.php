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
        $rules = [
            'fecha' => 'required',
            'valor' => 'required',
        ];
    
        // Verifica si hay datos para referencia y cantidad
        if ($this->filled('referencia') && $this->filled('cantidad')) {
            // Obtén la cantidad de elementos en los arreglos referencia y cantidad
            $count = count($this->input('referencia'));
    
            // Itera sobre los elementos y agrega reglas de validación requeridas para cada conjunto de datos
            for ($i = 0; $i < $count; $i++) {
                // Añade reglas de validación para cada conjunto de datos
                $rules['referencia.' . $i] = 'required';
                $rules['cantidad.' . $i] = 'required|numeric|min:1'; // Por ejemplo, requiere que la cantidad sea un número y mayor o igual a 1
            }
        }
    
        return $rules;
    }
}
