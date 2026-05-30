<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
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
            'company_name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'description' => ['required', 'string'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'company_name.required' => 'Nama perusahaan wajib diisi.',
            'company_name.max' => 'Nama perusahaan tidak boleh lebih dari 255 karakter.',
            'position.required' => 'Jabatan/Posisi wajib diisi.',
            'position.max' => 'Jabatan/Posisi tidak boleh lebih dari 255 karakter.',
            'start_date.required' => 'Tanggal mulai kerja wajib diisi.',
            'start_date.date' => 'Format tanggal mulai kerja tidak valid.',
            'end_date.date' => 'Format tanggal selesai kerja tidak valid.',
            'end_date.after_or_equal' => 'Tanggal selesai harus lebih besar atau sama dengan tanggal mulai kerja.',
            'description.required' => 'Deskripsi pekerjaan/pengalaman wajib diisi.',
        ];
    }
}
