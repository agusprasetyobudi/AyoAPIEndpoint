<?php

namespace App\Http\Requests\API\MatchLog;

use Illuminate\Foundation\Http\FormRequest;

class CreateMatchLogRequest extends FormRequest
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
            'match_id'=>'required|exists:schedule_matches,id',
            'person_id'=>'required|exists:team_people,id',
            'time_goal'=>'required|unique:schedule_match_logs,time_goal'

        ];
    }

    public function messages()
    {
        return [
            'match_id.required'   => 'Schedule match harus terisi',
            'match_id.exists'     => 'Schedule match tidak di temukan',
            'person_id.required'  => 'Team Person harus terisi',
            'person_id.exists'    => 'Team Person tidak di temukan'
        ];
    }
}
