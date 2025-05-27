<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $companyTypes = [
            'Webtoon Studio',
            'Anime Studio',
            'Manga Studio',
            'Design Agency'
        ];
        return view('auth.register-company', compact('companyTypes'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'company_name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
            'company_type' => ['required', 'string', 'in:Webtoon Studio,Anime Studio,Manga Studio,Design Agency'],
            'country' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
            'contact_person_name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
            'work_email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'
            ],
            'terms' => ['required', 'accepted']
        ], [
            'company_name.required' => 'Nama perusahaan harus diisi',
            'company_name.regex' => 'Nama perusahaan hanya boleh berisi huruf dan spasi',
            'company_name.max' => 'Nama perusahaan maksimal 255 karakter',

            'company_type.required' => 'Tipe perusahaan harus dipilih',
            'company_type.in' => 'Tipe perusahaan tidak valid',

            'country.required' => 'Negara harus diisi',
            'country.regex' => 'Nama negara hanya boleh berisi huruf dan spasi',
            'country.max' => 'Nama negara maksimal 255 karakter',

            'contact_person_name.required' => 'Nama kontak harus diisi',
            'contact_person_name.regex' => 'Nama kontak hanya boleh berisi huruf dan spasi',
            'contact_person_name.max' => 'Nama kontak maksimal 255 karakter',

            'work_email.required' => 'Email harus diisi',
            'work_email.email' => 'Format email tidak valid',
            'work_email.unique' => 'Email sudah terdaftar',
            'work_email.max' => 'Email maksimal 255 karakter',

            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan karakter khusus',

            'terms.required' => 'Anda harus menyetujui syarat dan ketentuan',
            'terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan'
        ]);

        try {
            DB::beginTransaction();

            // Create company
            $company = Company::create([
                'name' => $request->company_name,
                'type' => $request->company_type,
                'country' => $request->country
            ]);

            // Generate registration code
            $registrationCode = 'COMP-' . strtoupper(Str::random(8));

            // Create admin user
            $user = User::create([
                'name' => $request->contact_person_name,
                'email' => $request->work_email,
                'password' => Hash::make($request->password),
                'role' => 'company',
                'company_id' => $company->id,
                'registration_code' => $registrationCode
            ]);

            DB::commit();

            // Login the user
            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Selamat datang di dashboard.');

        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error
            Log::error('Company Registration Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return back()
                ->with('error', 'Terjadi kesalahan saat registrasi: ' . $e->getMessage())
                ->withInput();
        }
    }
}
