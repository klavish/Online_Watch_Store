<?php

namespace App\Http\Controllers;
use App\Models\Country;
use App\Models\Lineitem;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  
    public function userProfile(Request $request){
        $user = auth()->user();
        $lineitems = Lineitem::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
        $countries = Country::all();
        return view('user_profile', compact('user', 'countries', 'lineitems'));
    }

  public function userProfileUpdate(Request $request){
    $this->validate($request,[
      'fname' => 'required|min:3|max:15|string',
      'lname' => 'required|min:3|max:15|string|different:fname',
      'email' => 'required|email',
      'contact' => 'numeric',
      'gender' => 'required|in:Male,Female,Others',
      'address' => 'required|string',
      'country' =>  'required',
    ]);
    $requestData = $request->except(['_token', 'method', 'update']);
    $user = User::find(auth()->user()->id);
    $user->update($requestData);
    return redirect()->route('user_profile')->with('success', 'User data Updated Successfully');
    }

    public function userProfileImageUpdate(Request $request){
      $this->validate($request,[
        'profile' => 'required|mimes:jpg,jpeg,png',
      ]);
      $requestData = $request->except(['_token', 'method', 'update']);
      $imgName = 'lv'.rand().'.'.$request->profile->extension();
      $request->profile->move(public_path('profiles/'), $imgName);
      $requestData['profile'] = $imgName;
      $user = User::find(auth()->user()->id);
      $existingProfile = $user->profile;
      $user->update($requestData);
      $profileExists = public_path("profiles/$existingProfile");
      if(file_exists($profileExists)){
        unlink("profiles/$existingProfile");
      }
      return redirect()->route('user_profile')->with('success', 'User Image Updated Successfully');

    }



}
