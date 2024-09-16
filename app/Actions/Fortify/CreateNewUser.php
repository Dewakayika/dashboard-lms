<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Intern;
use App\Models\Talent;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'registration_code' => ['required', 'string', 'exists:roles,registration_code'],
        ])->validate();

        // Cari role berdasarkan kode registrasi
        $role = Roles::where('registration_code', $input['registration_code'])->first();

        if (!$role) {
            // Handle error jika kode registrasi tidak valid
            throw new \Exception('Invalid registration code');
        }

        // $user = User::create([
        //     'name' => $input['name'],
        //     'email' => $input['email'],
        //     'phone' => $input['phone'],
        //     'address' => $input['address'],
        //     'gender' => $input['gender'],
        //     'role' => $role->role_type,
        //     'password' => Hash::make($input['password']),
        // ]);

        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->phone = $input['phone'];
        $user->address = $input['address'];
        $user->gender = $input['gender'];
        $user->role = $role->role_types;
        $user->password = Hash::make($input['password']);
        $user->save();

        if ($role->role_type == 'intern') {
            $intern = new Intern();
            $intern->job = $input['job'];
            $intern->user_id = $user->id;
            $intern->save();
        }

        if ($role->role_type == 'talent') {
            $talent = new Talent();
            $talent->school = $input['school'];
            $talent->date_of_birth = $input['date_of_birth'];
            $talent->bank_name = $input['bank_name'];
            $talent->bank_account = $input['bank_account'];
            $talent->user_id = $user->id;
            $talent->save();
        }
        return $user;

    //     // Log the user in
    // Auth::login($user);


        // $this->guard()->login($user);

        // // Redirect to additional info page based on role
        // return redirect()->route('register.additional-info');
    }
}
