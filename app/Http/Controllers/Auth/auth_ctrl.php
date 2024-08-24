<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\Login_history;
use App\Models\User;
use App\Models\verification_email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class auth_ctrl extends Controller
{
    //login form
    public function login_page()
    {
        return view('Auth_pages/login');
    }
    //register form
    public function register_page()
    {
        return view('Auth_pages/register');
    }
    //register functions
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ]
    );

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user_code=rand(100,100000);
        $user->code=$user_code;
        $user->save();

        $validation_token = rand(10, 10000);
        
        $get_token = new verification_email();
        $get_token->email = $request->email;
        $get_token->token = $validation_token;
        $get_token->save();

        $get_email = $request->email;
        $get_name = $request->name;
        Mail::to($request->email)->send(new WelcomeMail($get_email, $get_name, $validation_token));

        return redirect('activate_page');
    }
    public function activate_page()
    {
        return view('users_pages/activate_email');
    }
    public function activate_email(Request $request)
    {
        $get_code = $request->code;
        $get_token = verification_email::where('token', $get_code)->first();

        if ($get_token) {
            if ($get_token->isactivated == 1) {
                return redirect()->back()->with('error', "The code has already been activated.");
            }

            $get_token->isactivated = 1;
            $get_token->save();

            $user = User::where('email', $get_token->email)->first();
            if (!$user) {
                return redirect()->back()->with('error', "Wrong code");
            } else {
                if ($user->isactivated == 1) {
                    return redirect()->back()->with('error', "The code has already been activated.");
                }
                $user->isactivated = 1;
                $user->save();
            }

            return redirect('/signin');
        } else {
            return redirect()->back()->with('error', "Wrong code");
        }
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->isactivated == 1) {
                $request->session()->regenerate();
                $admin=env('admin');
                $admin2=env('admin2');
                $admin3=env('admin3');
                if (Auth::user()->role_as == $admin|| Auth::user()->role_as == $admin2 || Auth::user()->role_as == $admin3) {
                    $login_history = new Login_history();
                    $login_history->user_email = $request->email;
                    $login_history->user_status = Auth::user()->role_as;
                    $login_history->login_time = now();
                    $login_history->login_ip = $request->ip();
                    $userAgent = $request->header('User-Agent');
                    $browserName = $this->getBrowserName($userAgent);
                    $login_history->login_agent = $browserName;
                    $login_history->save();
                    return redirect('admin/index');
                } elseif (Auth::user()->role_as == '0' || Auth::user()->role_as == 'Supplier$012!_1$') {
                    // User
                    return redirect('/');
                }
            } else {
                return redirect()->back()->with('error', 'Please check your email to activate your account.');
            }
        }

        return redirect()->back()->with('error', 'Incorrect email or password');
    }

    private function getBrowserName($userAgent)
    {
        $browserName = 'Unknown';

        // Define regular expressions to match common browsers
        $patterns = [
            '/(MSIE|Trident)/i' => 'Internet Explorer',
            '/Firefox/i' => 'Firefox',
            '/Edge/i' => 'Microsoft Edge',
            '/Chrome/i' => 'Chrome',
            '/Safari/i' => 'Safari',
            '/Opera/i' => 'Opera',
        ];

        // Check if the user agent matches any of the patterns
        foreach ($patterns as $pattern => $name) {
            if (preg_match($pattern, $userAgent)) {
                $browserName = $name;
                break;
            }
        }

        return $browserName;
    }
    //logout
    public function logout_fun(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
