<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\User;
use App\Models\Registro;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }  
      

    public function customLogin(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('usuario', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }



    public function registration()
    {
        return view('auth.registration');
    }
      

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:registros',
            'password' => 'required|min:6',
            'usuario' => 'required',
            'ap_paterno' => 'required|max:80',
            'ap_materno' => 'required|max:80',
            'role_id' => 'required',
            'telefono' => 'required|max:10|digits:10',
        ]);
           
        $data = $request->all();
        $check = Registro::create($data);
         
        return redirect("login")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'usuario' => $data['usuario'],
        'ap_paterno' => $data['ap_paterno'],
        'ap_materno' => $data['ap_materno'],
        'role_id' => $data['cargo'],
        'telefono' => $data['telefono'],
      ]);
    }    
    

    public function dashboard()
    {
        if(Auth::check()){
            return view('panel');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    
}
