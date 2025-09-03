<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKandidatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'visi' => 'required|string|max:1000',
            'misi' => 'required|string|max:1000',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama kandidat harus diisi.',
            'visi.required' => 'Visi kandidat harus diisi.',
            'misi.required' => 'Misi kandidat harus diisi.',
            'foto.image' => 'Foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat jpeg, png, jpg, atau gif.',
            'foto.max' => 'Foto maksimal 2MB.',
        ];
    }
}
