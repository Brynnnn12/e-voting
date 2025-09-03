<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVotingRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'pemilihan_id' => 'required|exists:pemilihans,id',
            'kandidat_id' => 'required|exists:kandidats,id',
            'waktu' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'User ID harus diisi.',
            'user_id.exists' => 'User ID tidak valid.',
            'pemilihan_id.required' => 'Pemilihan ID harus diisi.',
            'pemilihan_id.exists' => 'Pemilihan ID tidak valid.',
            'kandidat_id.required' => 'Kandidat ID harus diisi.',
            'kandidat_id.exists' => 'Kandidat ID tidak valid.',
            'waktu.required' => 'Waktu harus diisi.',
            'waktu.date' => 'Waktu harus berupa tanggal yang valid.',
        ];
    }
}
