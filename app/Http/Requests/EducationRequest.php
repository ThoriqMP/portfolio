<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
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
        $currentYear = date('Y') + 10; // Allow reasonable future years
        return [
            'institution_name' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'string', 'max:255'],
            'start_year' => ['required', 'integer', 'min:1900', 'max:' . $currentYear],
            'end_year' => ['nullable', 'integer', 'min:1900', 'max:' . $currentYear, 'gte:start_year'],
            'description' => ['nullable', 'string'],
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
            'institution_name.required' => 'Nama institusi wajib diisi.',
            'institution_name.max' => 'Nama institusi tidak boleh lebih dari 255 karakter.',
            'degree.required' => 'Gelar/Kualifikasi wajib diisi.',
            'degree.max' => 'Gelar/Kualifikasi tidak boleh lebih dari 255 karakter.',
            'start_year.required' => 'Tahun mulai wajib diisi.',
            'start_year.integer' => 'Tahun mulai harus berupa angka tahun.',
            'start_year.min' => 'Tahun mulai minimal tahun 1900.',
            'end_year.integer' => 'Tahun lulus harus berupa angka tahun.',
            'end_year.min' => 'Tahun lulus minimal tahun 1900.',
            'end_year.gte' => 'Tahun lulus harus lebih besar atau sama dengan tahun mulai.',
        ];
    }
}
