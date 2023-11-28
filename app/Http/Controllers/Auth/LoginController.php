<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:shipper')->except('logout');
    }

    public function showAdminLoginForm(): View
    {
        return view('admin.auth.login', ['url' => route('admin.login-view'), 'title' => 'Admin']);
    }

    public function adminLogin(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt($request->only(['email','password']), $request->get('remember'))) {
            return redirect()->route('dashboard');
        }

        return back()->withInput($request->only('email', 'remember'));
    }

    public function showShipperLoginForm(): View
    {
        return view('shipper.auth.login', ['url' => route('shipper.login-view'), 'title' => 'Shipper']);
    }

    public function shipperLogin(Request $request): RedirectResponse
    {

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('shipper')->attempt($request->only(['email','password']), $request->get('remember'))) {
            return redirect()->route('shipper-page');
        }

        return back()->withInput($request->only('email', 'remember'));
    }
}
