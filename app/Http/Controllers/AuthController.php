<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use DB;


class AuthController extends Controller
{
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function LoginView()
	{
		return view('auth.v_login');
	}

	public function rules_login()
	{
		$loginType = filter_var($this->request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

		return [
			$loginType => 'required|string',
			'password' => 'required|string'
		];
	}

	public function LoginProcess(Request $request)
	{
		try {

			$loginType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
			
			$login_users = [
				$loginType => $request->email,
				'password' => $request->password,
				'role' => 'users',
			];
			$login_admin = [
				$loginType => $request->email,
				'password' => $request->password,
				'role' => 'admin',
			];

			$this->validate($request, $this->rules_login());

			if (Auth::guard('users')->attempt($login_users)) {

				return redirect('/users');
			}elseif (Auth::guard('users')->attempt($login_admin)) {
				return redirect('/admin');
			}

			return redirect()->back()->with('gagal', 'Login Gagal');

		} catch (Exception $e) {

			return redirect()->back()->with('gagal', 'Login Gagal');
		}
	}

	public function Logout()
	{
		if (Auth::guard('users')->check()) {
			Auth::guard('users')->logout();
		} 

		return redirect('/login');
	}
}
