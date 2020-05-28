<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
use App\Admin;
use App\Mail\AdminResetPassword;
use DB;
use Carbon\Carbon;
use Mail;

use Illuminate\Support\Facades\Password;

class AdminAuth extends Controller
{
    //



    public function login()
    {
        return view('admin.login');
    }

    public function dologin()
    {
        $rememberme = request('rememberme') == 1 ? true : false;
        if (admin()->attempt(['email' => request('email'), 'password' => request('password')], $rememberme)) {
            return redirect('admin');
        } else {
            session()->flash('error', trans('admin.inccorrect_information_login'));
            return redirect('admin/login');
        }
    }


    public function logout()
    {
        admin()->logout();
        return redirect('admin/login');
    }

    public function forgot_password()
    {
        return view('admin.forgot_password');
    }
    public function forgot_password_post(Request $request)
    {
        
        $admin = Admin::where('email', request('email'))->first();

        if (!empty($admin)) {
            $token = request('_token');//str_random(60); //app('auth.password.broker')->createToken($admin);
            //$token = app('auth.password.broker')->createToken($admin);
            //dd($token);

            $data  = DB::table('password_resets')->insert([
                'email'      => $admin->email,
                'token'      => $token,
                'created_at' => Carbon::now(),
            ]);
            //dd($token);
            //return new AdminResetPassword(['data'=>$admin , 'token'=>$token]);
            Mail::to($admin->email)->send(new AdminResetPassword(['data' => $admin, 'token' => $token]));
            session()->flash('success', trans('admin.the_link_reset_sent'));
            return back();
        }
        return back();
    }

    public function reset_password($token)
    {
        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(1))->first();
        if (!empty($check_token)) {
            //dd($check_token);
            return view('admin.reset_password', ['data' => $check_token]);
        } else {
            return redirect(aurl('forgot/password'));
        }
    }


    public function reset_password_final($token)
    {

        $this->validate(request(), [
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
        ], [], [
            'password'              => 'Password',
            'password_confirmation' => 'Confirmation Password',
        ]);

        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(1))->first();
        if (!empty($check_token)) {
            $admin = Admin::where('email', $check_token->email)->update([
                'email'    => $check_token->email,
                'password' => bcrypt(request('password'))
            ]);
            DB::table('password_resets')->where('email', request('email'))->delete();
            admin()->attempt(['email' => $check_token->email, 'password' => request('password')], true);
            return redirect(aurl());
        } else {
            return redirect(aurl('forgot/password'));
        }
    }
}