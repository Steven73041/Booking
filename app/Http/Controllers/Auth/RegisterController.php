<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {

        return Validator::make($data, [
            'firstName' => 'required|max:50|min:3|regex:/^[A-Za-z]+$/',
            'lastName' => 'required|max:50|min:3|regex:/^[A-Za-z]+$/',
            'gdpr' => 'required',
            'email' => 'email|required|max:100|unique:users|regex:/^.+@.+$/i|min:7',
            'password' => 'string|min:8|confirmed|required|max:25|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/i',
        ], $errors = [
            'gdpr' => 'If you want to register, you must consent to keep your data in our database till you request deletion',
            'firstName.required' => 'Please enter a valid First Name with maximum 50 characters',
            'lastName.required' => 'Please enter a valid Last Name with maximum 50 characters',
            'email.regex' => 'Please enter a valid e-mail address',
            'email.unique' => 'This e-mail is already in use',
            'email.min' => 'Your email address should be 7 characters at minimum',
            'password.min' => 'Password should be at least 8 characters',
            'password.regex' => 'Your password must contain at least 1 uppercase, 1 number and 1 symbol',
            'password.confirmed' => 'Your password is not the same in both password fields.',
            'firstName.regex' => 'Only letters allowed for First Name',
            'lastName.regex' => 'Only letters allowed for First Name',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data) {
        return User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
