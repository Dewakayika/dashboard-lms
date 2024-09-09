<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Intern;
use App\Models\Talent;
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
        ])->validate();

        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->phone = $input['phone'];
        $user->address = $input['address'];
        $user->gender = $input['gender'];
        $user->role = $input['role'];
        $user->password = Hash::make($input['password']);
        $user->save();

        if ($input['role'] == 'intern') {
            $intern = new Intern();
            $intern->job = $input['job'];
            $intern->user_id = $user->id;
            $intern->save();
        }

        if ($input['role'] == 'talent') {
            $talent = new Talent();
            $talent->school = $input['school'];
            $talent->date_of_birth = $input['date_of_birth'];
            $talent->bank_name = $input['bank_name'];
            $talent->bank_account = $input['bank_account'];
            $talent->user_id = $user->id;
            $talent->save();
        }
        return $user;
    }
}
