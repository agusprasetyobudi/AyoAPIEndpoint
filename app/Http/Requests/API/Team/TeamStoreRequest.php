<?php

namespace App\Http\Requests\API\Team;

use Illuminate\Foundation\Http\FormRequest;

use function PHPSTORM_META\map;

class TeamStoreRequest extends FormRequest
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
            'name'          => 'required|unique:teams',
            'team_logo'          => 'required|image|mimes:png,jpg,jpeg|max:1080',
            'year_founded'  => 'required',
            'address'       => 'required',
            'city'          => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Nama Tim harus terisi',
            'name.unique'           => 'Nama Tim sudah terpakai',
            'team_logo.required'    => ':attribute harus terisi',
            'team_logo.image'       => ':attribute harus berupa gambar',
            'team_logo.mimes'       => ':attribute harus tipe: png,jpg,jpeg',
            'team_logo.max'         => ':attribute tidak boleh lebih dari :max'
        ];
    }
}
