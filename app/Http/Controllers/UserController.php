<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;

class UserController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = User::all();
        return view('users.index', compact('users'),['title'=>'Users']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('users.create',['title'=>'Register']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'firstName' => 'required|max:50|min:3|regex:/^[A-Za-z]+$/',
            'lastName' => 'required|max:50|min:3|regex:/^[A-Za-z]+$/',
            'gdpr' => 'required',
            'email' => 'required|max:100|unique:users|regex:/^.+@.+$/i|min:7',
            'password' => 'confirmed|required|max:25|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/i',
        ],$errors = [
            'gdpr' => 'If you want to register, you must consent to keep your data in our database till you request deletion',
            'firstName.required' => 'Please enter a valid First Name with maximum 50 characters',
            'lastName.required' => 'Please enter a valid Last Name with maximum 50 characters',
            'email.regex' => 'Please enter a valid e-mail address',
            'email.unique' => 'This e-mail is already in use',
            'email.min' => 'Your email address should be 7 characters at minimum',
            'password.regex' => 'Your password must contain at least 1 uppercase, 1 number and 1 symbol',
            'password.confirmed' => 'Your password is not the same in both password fields.',
            'firstName.regex' => 'Only letters allowed for First Name',
            'lastName.regex' => 'Only letters allowed for First Name',
        ]);

        if ($validator->fails()) {
            return redirect('user/create')->withErrors($validator)->withInput();
        }
        User::create($request->all());
        return redirect('/rooms');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user){
        return view('users.show', compact('user'),['title'=>$user->firstName." ".$user->lastName]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user){
        $user = Auth::user();
        return view('users.edit', compact('user'),['title'=>$user->firstName." ".$user->lastName]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
        $validator = Validator::make($request->all(),[
            'firstName' => 'max:50|min:3|regex:/^[A-Za-z]+$/',
            'lastName' => 'max:50|min:3|regex:/^[A-Za-z]+$/',
            'email' => 'max:100|regex:/^.+@.+$/i|unique:users,email,'.$user->id,
            'phone' => 'max:20|regex:/[0-9]+$/',
            'city' => 'max:25|regex:/[a-zA-Z]+$/',
            'password' => 'confirmed|required|max:25|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/i',
	        'age' => 'max:2|regex:/[0-9]+$/',
        ],$errors = [
        	'age.regex' => 'Age should be a number',
	        'age.max' => 'Max Numbers: 2',
	        'city.regex' => 'Enter a valid City',
            'phone.regex' => 'Only numbers are allowed in phone field',
            'email.regex' => 'Please enter a valid e-mail address',
            'email.unique' => 'This e-mail is already in use',
            'email.min' => 'Your email address should be 7 characters at minimum',
            'password.regex' => 'Your password must contain at least 1 uppercase, 1 number and 1 symbol',
            'password.confirmed' => 'Your password is not the same in both password fields.',
            'firstName.regex' => 'Only letters allowed for First Name',
            'lastName.regex' => 'Only letters allowed for First Name',
        ]);
        if ($validator->fails()) {
            return redirect('user/'.$user->id.'/edit')->withErrors($validator)->withInput();
        }
        $user->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'password' => bcrypt($request->password),
	        'age' => $request->age
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user){
        $user->delete();
    }
}
