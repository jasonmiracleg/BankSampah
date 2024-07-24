<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function registerPage()
    {
        return view('register');
    }

    public function loginPage()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $name = $request->input('name');
        $telephone = $request->input('telephone');
        
        // Attempt to find the user based on the provided rt_rw and telephone
        $user = User::where('name', $name)
                    ->where('telephone', $telephone)
                    ->first();
        
        if ($user) {
            // Log the user in manually
            Auth::login($user);
        
            // Redirect to the intended page after successful login
            return redirect()->route('home');
        } else {
            // User not found based on the provided credentials
            return redirect()->back()->withErrors([
                'name' => 'Kombinasi nama dan nomor telepon tidak valid.',
            ]);
        }        
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', "unique:users"],
            'rt' => ['required', 'string'],
            'telephone' => ['required', 'string', 'min:10', 'max:12'],
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.unique' => 'Nama sama dengan nasabah lain',
            'rt.required' => 'RT/RW harus diisi',
            'telephone.required' => 'Nomor telepon harus diisi',
            'telephone.min' => 'Nomor telepon minimal 10 digit',
            'telephone.max' => 'Nomor telepon minimal 12 digit'
            // 'username.required' => 'Username harus diisi.',
            // 'username.min' => 'Username minimal 8 karakter.',
            // 'username.max' => 'Username maksimal 8 karakter.',
            // 'username.unique' => 'Username sudah digunakan.',
            // 'password.required' => 'Password harus diisi.',
            // 'password.min' => 'Password minimal 8 karakter.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = $this->create($request->all());

        if (empty($user)) {
            redirect()->route('register');
        }
        return redirect()->route('home');
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'rt_rw' => $data['rt'],
            'telephone' => $data['telephone'],
            'is_admin' => '0',
            'saldo' => 0,
            'total_income' => 0,
            'total_outcome' => 0
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.page');
    }
}
