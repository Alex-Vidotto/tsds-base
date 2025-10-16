<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGrupoTrabajoRequest extends FormRequest
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
//            'nombre' => 'required|string|max:255',
//            'car_id' => [
//                'nullable',
//                'exists:cars,id',
//                Rule::unique('grupo_trabajos', 'car_id'),
//            ],
//            'empleados' => 'nullable|array',
//            'empleados.*' => [
//                'exists:users,id',
//                function ($attribute, $value, $fail) {
//                    $existe = DB::table('grupo_trabajo_usuario')->where('user_id', $value)->exists();
//                    if ($existe) {
//                        $fail("El usuario con ID $value ya está asignado a otro grupo.");
//                    }
//                },
//            ],
        ];
    }
}
