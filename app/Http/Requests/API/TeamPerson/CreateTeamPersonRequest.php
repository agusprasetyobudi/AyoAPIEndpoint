<?php

namespace App\Http\Requests\API\TeamPerson;

use Illuminate\Foundation\Http\FormRequest;

class CreateTeamPersonRequest extends FormRequest
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
            'team_id'=>'required|integer|exists:teams,id',
            'person_name'=>'required',
            'tinggi'=>'required|integer',
            'berat'=>'required|integer',
            'posisi'=>'required',
            'nomor_punggung'=>'required|integer',
        ];
    }
}
