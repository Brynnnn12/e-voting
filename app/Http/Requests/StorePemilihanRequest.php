<?php

namespace App\Http\Requests;

use App\Models\Pemilihan;
use Illuminate\Foundation\Http\FormRequest;

class StorePemilihanRequest extends FormRequest
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
            'nama_pemilihan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status' => 'required|in:' . implode(',', [
                Pemilihan::STATUS_AKTIF,
                Pemilihan::STATUS_NONAKTIF,
                Pemilihan::STATUS_SELESAI,
            ]),
            'published_at' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_pemilihan.required' => 'Nama pemilihan wajib diisi.',
            'nama_pemilihan.string' => 'Nama pemilihan harus berupa teks.',
            'nama_pemilihan.max' => 'Nama pemilihan maksimal 50 karakter.',

            'deskripsi.string' => 'Deskripsi harus berupa teks.',

            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_mulai.date' => 'Tanggal mulai harus berupa format tanggal yang valid.',

            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi.',
            'tanggal_selesai.date' => 'Tanggal selesai harus berupa format tanggal yang valid.',
            'tanggal_selesai.after' => 'Tanggal selesai harus setelah tanggal mulai.',

            'status.required' => 'Status wajib diisi.',
            'status.in' => 'Status hanya boleh: aktif, nonaktif, atau selesai.',

            'published_at.date' => 'Tanggal publikasi harus berupa format tanggal yang valid.',
        ];
    }
}
