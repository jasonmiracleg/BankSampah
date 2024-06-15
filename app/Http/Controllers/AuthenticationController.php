<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function registerPage(){
        return view('register');
    }

    public function loginPage(){
        return view('login');
    }

    public function authenticate(Request $request){
        $user = [
            'username' => $request->username,
            'password' => $request->password,
        ];
    
        if (Auth::attempt($user)) {
            return redirect()->route('home');
        } else {
            if (User::where('username', $request->username)->exists()) {
                return redirect()->back()->withErrors(['password' => 'Password salah.']);
            } else {
                return redirect()->back()->withErrors(['username' => 'Username tidak terdaftar.']);
            }
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:8', 'max:25', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ], [
            'name.required' => 'Nama harus diisi.',
            'username.required' => 'Username harus diisi.',
            'username.min' => 'Username minimal 8 karakter.',
            'username.max' => 'Username maksimal 8 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = $this->create($request->all());

        if (empty($user)) {
            redirect()->route('register');
        }
        return redirect()->route('login.page');
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'is_admin' => $data['is_admin'],
            'saldo' => 0,
            'total_income' => 0,
            'total_outcome' => 0
        ]);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login.page');
    }
}
