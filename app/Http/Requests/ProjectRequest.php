<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Guards are handled by route middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isCreate = $this->isMethod('post');

        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => [
                $isCreate ? 'required' : 'nullable',
                'image',
                'mimes:jpeg,png,jpg',
                'max:10240' // Max 10MB
            ],
            'project_link' => ['nullable', 'url'],
            'grid_span' => ['required', 'integer', 'between:1,3'],
            'thumbnail_composition' => ['required', 'string', 'in:single,split,mosaic,carousel'],
            'additional_images' => ['nullable', 'array'],
            'additional_images.*' => ['image', 'mimes:jpeg,png,jpg', 'max:10240'],
            'badges' => ['nullable', 'array'],
            'badges.*' => ['integer', 'exists:badges,id'],
            'new_badges' => ['nullable', 'string'],
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
            'title.required' => 'Judul proyek wajib diisi.',
            'title.max' => 'Judul proyek tidak boleh lebih dari 255 karakter.',
            'description.required' => 'Deskripsi proyek wajib diisi.',
            'image.required' => 'File gambar proyek wajib diunggah.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'image.max' => 'Ukuran gambar utama tidak boleh melebihi 10MB.',
            'thumbnail_composition.required' => 'Komposisi tata letak gambar wajib ditentukan.',
            'thumbnail_composition.in' => 'Pilihan komposisi tata letak gambar tidak valid.',
            'additional_images.*.image' => 'File pendukung galeri harus berupa gambar.',
            'additional_images.*.mimes' => 'Format gambar pendukung galeri harus jpeg, png, atau jpg.',
            'additional_images.*.max' => 'Ukuran masing-masing gambar pendukung tidak boleh melebihi 10MB.',
            'project_link.url' => 'Format link proyek harus berupa URL yang valid (misal: https://example.com).',
        ];
    }
}
