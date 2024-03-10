<?php

namespace App\Http\Controllers;
use App\Models\Country;
use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use App\Mail\SendForgotPasswordEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Authenticationcontroller extends Controller
{
    public function register(Request $request){
       
        
        $countries = Country::all();
        return view('register', compact('countries'));
    }

    public function storeUser(Request $request){
        $this->validate($request, [
            'fname' => 'required|min:3|max:15|string',
            'lname' => 'required|min:3|max:15|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'contact' => 'numeric|nullable',
            'gender' => 'required|in:Male,Female,Other',
            'address' => 'required|string',
            'country' => 'required|exists:countries,id',
            'profile' => 'required|mimes:jpg,jpeg,png'
        ]);
        $requestData = $request->except(['_token', 'register']);
        $imgName = 'lv_'.rand() . '.'. $request->profile->extension();
        $request->profile->move(public_path('profiles/'), $imgName);
        $requestData['profile'] = $imgName;
        $requestData['role_id'] = User::USER_ROLE;

         $user = User::create($requestData);
        event(new WelcomeEmail($user));
        return redirect()->route('home', [], 301)->with('success', 'user Inserted Successfully');
       
    }

    public function login(Request $request){
        
        return view('login');
    }

    public function authenticate(Request $request){
        $this->validate($request, [
             'email' => 'required',
             'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){

           if(auth()->user()->role_id == User::ADMIN_ROLE){
            return redirect()->route('admin_home', [], 301);
           }else{
            return redirect()->route('home', [], 301);
           }
        }else{
            return redirect()->intended('login')->withSuccess('Error Try Again');

        }
        
    }

    public function forgotPassword(Request $request){

        return view('forgot_password');
    }

    public function sendForgotPasswordEmail(Request $request){
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
        ]);
        // $token = $request->_token; 
        // or 
        // $token = Str::random('30');
        $requestData = $request->except(['_token', 'forgot_pass_btn']);
        $requestData['token'] = Str::random('30');
        $forgotPasswordData = DB::table('password_reset_tokens')->insert($requestData);
        Mail::to($requestData['email'])->send(new SendForgotPasswordEmail($requestData));
        
        return view('forgot_password');
    }


    public function resetPassword(Request $request, $token){
        $checkData = DB::table('password_reset_tokens')->where('email', $request->email)->where('token', $token)->count();
        if($checkData > 0){
            $email = $request->email;
            return view('reset_password', compact('email'));
        }else{
            return redirect()->route('forgot_password', [], 301)->with('danger', 'Invalid token');
        }
       
    }

    public function resetPasswordData(Request $request){
        $this->validate($request, [
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password',
        ]);
        $user = User::where('email', $request->email)->update(['password' => bcrypt($request->password)]);
        return redirect()->route('login', [], 301)->with('success', 'Password Reset Successfully');
    }
    public function logout(Request $request){

        Session::flush();
        Auth::logout();
        return redirect('login', 301);
    }
}
