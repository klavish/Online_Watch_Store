<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Country;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request){
        return view('admin.index');
    }

    public function usersList(Request $request){
        $users = User::all();
        return view('admin.users_list', compact('users'));
    }

    public function editUsers(Request $request, $id){
    $user = User::find($id);
    if(empty($user)){
        return back()->with('warning', 'User not found');
    }
    $countries = Country::all();
    return view('admin.user_edit', compact('user', 'countries'));
    }

    public function updateUsers(Request $request, $id){

        $this->validate($request,[
            'fname' => 'required|min:3|max:15|string',
            'lname' => 'required|min:3|max:15|string|different:fname',
            'email' => 'required|email',
            'contact' => 'numeric',
            'gender' => 'required|in:Male,Female,Others',
            'role_id' => 'required|in:0,1',
            'address' => 'required|string',
            'country' =>  'required',
          ]);
          $requestData = $request->except(['_token', 'method', 'update']);
          $user = User::find($id);
          if(!empty($user)){
              $user->update($requestData);
              return redirect()->route('admin_user_list')->with('success', 'User data Updated Successfully');
           }else{
            return redirect()->route('admin_user_list')->with('danger', 'Something went wrong');

           }
    }

    public function updateUsersProfile(Request $request, $id){
        $this->validate($request,[
            'profile' => 'required|mimes:jpg,jpeg,png',
          ]);
          $requestData = $request->except(['_token', 'method', 'update']);
          $imgName = 'lv'.rand().'.'.$request->profile->extension();
          $request->profile->move(public_path('profiles/'), $imgName);
          $requestData['profile'] = $imgName;
          $user = User::find($id);
          if(!empty($user)){
          $existingProfile = $user->profile;
          $user->update($requestData);
          $profileExists = public_path("profiles/$existingProfile");
          if(file_exists($profileExists)){
            unlink("profiles/$existingProfile");
          }
          return redirect()->route('admin_user_list')->with('success', 'User Image Updated Successfully');
        }else{
          return redirect()->route('admin_user_list')->with('danger', 'Something went wlist');

        }
    }

    public function registerUsersProfile(Request $request){
        $countries = Country::all();
        return view('admin.Users_register', compact('countries'));
    }

    public function registerUsersProfileData(Request $request){
        $this->validate($request, [
            'fname' => 'required|min:3|max:15|string',
            'lname' => 'required|min:3|max:15|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'contact' => 'numeric|nullable',
            'gender' => 'required|in:Male,Female,Other',
            'role_id' => 'required|in:0,1',
            'address' => 'required|string',
            'country' => 'required|exists:countries,id',
            'profile' => 'required|mimes:jpg,jpeg,png'
        ]);
        $requestData = $request->except(['_token', 'register']);
        $imgName = 'lv_'.rand() . '.'. $request->profile->extension();
        $request->profile->move(public_path('profiles/'), $imgName);
        $requestData['profile'] = $imgName;
        $user = User::create($requestData);
        //event(new WelcomeEmail($user));
        if(!empty($user)){
            $user->update($requestData);
            return redirect()->route('admin_user_list')->with('success', 'User inserted Successfully');
         }else{
            return redirect()->route('admin_user_list')->with('danger', 'Something went wrong');
         }
    }

    public function changeUserStatus(Request $request, $id, $status = 1){
        $user = User::find($id);
        if(!empty($user)){
            $user->is_active = $status;
            $user->save();
            return redirect()->route('admin_user_list')->with('success', 'User status updated Successfully');
        }else{
           return redirect()->route('admin_user_list')->with('danger', 'Something went wrong');
        }
    }
}
