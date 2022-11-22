<?php

namespace App\Http\Requests\API\MatchSchedule;

use Illuminate\Foundation\Http\FormRequest;

class CreateMatchScheduleRequest extends FormRequest
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
            'match_date'    =>'required|date',
            'match_time'    =>'required',
            'location'      =>'required|string',
            'home_team'  =>'required|exists:teams,id',
            'away_team'  =>'required|exists:teams,id',
        ];
    }

    public function messages()
    {
        return [
            'match_date.required'=>'Tanggal pertandingan harus terisi',
            'match_date.date'=>'Tanggal pertandingan berupa tanggal',
            'match_time.required'=>'Waktu pertandingan hatus terisi',
            'location.required' => 'Lokasi pertandingan harus terisi',
            'location.string' => 'lokasi pertandingan berupa karakter',
            'home_team_id.exists' => 'Tim tuan rumah tidak tersedia, hubungi admin!',
            'away_team_id.exists' => 'Tim tamu tidak tersedia, hubungi admin!',
        ];
    }
}
