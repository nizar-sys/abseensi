<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreOrUpdateRombel extends FormRequest
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
            'nama_rombel' => 'required|unique:rombels,nama_rombel,' . $this->id,
            'rayon_id' => 'nullable|exists:rayons,uuid'
        ];
    }

    public function attributes()
    {
        return [
            'nama_rombel' => "Rombel",
            'rayon_id' => 'Rayon'
        ];
    }
}
