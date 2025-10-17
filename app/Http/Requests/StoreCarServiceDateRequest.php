<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCarServiceDateRequest extends FormRequest
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
            'fecha_mantenimiento' => [
                'required',
                'date',
                'after_or_equal:today',
                Rule::unique('car_service_dates')->where(function ($query) {
                    return $query->where('car_id', $this->car_id)
                                 ->whereDate('fecha_mantenimiento', $this->fecha_mantenimiento);
                }),
            ],
            'car_id' => 'required|exists:cars,id',
            'car_service_id' => 'required|exists:car_services,id',            
        ];
    }
    public function messages()
    {
        return [
            'fecha_mantenimiento.required' => 'La fecha de mantenimiento es obligatoria.',
            'fecha_mantenimiento.date' => 'La fecha debe tener un formato válido.',
            'fecha_mantenimiento.after_or_equal' => 'No se puede programar mantenimiento en una fecha pasada.',
            'fecha_mantenimiento.unique' => 'Ya existe un mantenimiento para este vehículo en esa fecha.',
            'car_id.required' => 'Debes seleccionar un vehículo.',
            'car_id.exists' => 'El vehículo seleccionado no existe.',
            'car_service_id.required' => 'Debes seleccionar un tipo de servicio.',
            'car_service_id.exists' => 'El servicio seleccionado no existe.',
        ];
    }
}
