<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company_name' => 'required|string|max:255',
            'company_type' => 'required|in:Webtoon Studio,Anime Studio,Manga Studio,Design Agency',
            'country' => 'required|string|max:255',
            'contact_person_name' => 'required|string|max:255',
            'work_email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required|accepted'
        ];
    }

    public function messages()
    {
        return [
            'company_name.required' => 'Nama perusahaan harus diisi',
            'company_type.required' => 'Tipe perusahaan harus dipilih',
            'company_type.in' => 'Tipe perusahaan tidak valid',
            'country.required' => 'Negara harus diisi',
            'contact_person_name.required' => 'Nama kontak harus diisi',
            'work_email.required' => 'Email harus diisi',
            'work_email.email' => 'Format email tidak valid',
            'work_email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'terms.required' => 'Anda harus menyetujui syarat dan ketentuan',
            'terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan'
        ];
    }
}