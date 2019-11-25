<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

	public function login(Request $request)
    {
        $this->validateLogin($request);
        if ($this->attemptLogin($request)) {
            return redirect($this->redirectTo)->with('success','登录成功');
        }else{
            return back()->withErrors(['loginError'=>'抱歉，账号或密码不正确']);
        }
            
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|string',
            //'captcha' => 'required|captcha',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        return auth()->attempt(
            $request->only('username', 'password'), $request->filled('remember')
        );

    }

    public function logout(){
        auth()->logout();
        session()->flush();
        return redirect(route('login'));
    }

}
