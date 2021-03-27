<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Model\Rol;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }*/
    public function formulario(){
		return view('login.login');
    }
    
    protected function sendFailedLoginResponse(Request $request){
        
       
        $errors=[$this->username() => 'login incorrecto'];
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    protected function redirectTo(){
        
        switch (auth()->user()->idrol) {
            case 3:
                return '/catalogos/tiporol/listado';

            break;
            case 2:
                return '/welcome';
                
            break;
            case 1:
                
                return '/catalogos/tiposervicio/listado';
            break;
        }
        
        
        
    }
    
    
}
