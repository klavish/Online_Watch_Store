@extends('layout_user')
@section('content')
<div>
    @if($errors->any())
    <div class="alert">
        <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif
<div class="w-full h-full flex flex-col  justify-center items-center">
    <h1 class="font-semibold text-xl text-center">User Registration Form</h1>
<form class="bg-slate-100 flex flex-col justify-center px-4 py-6 w-1/2" name="registration" enctype="multipart/form-data" method="post" action="{{ route('store_user') }}">
@csrf
<div class="grid grid-cols-2 gap-4">
    <label for="fname" class="text-sm font-medium">First Name<span class="text-red-600">*</span></label>
    <div>
        <input type="text" name="fname" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter First Name" value="{{ old('fname') }}">
        <span class="text-sm text-red-600"></span>
    </div>
    <label for="lname" class="text-sm font-medium">Last Name<span class="text-red-600">*</span></label>
    <div>
        <input type="text" name="lname" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Last Name" value="{{ old('lname') }}">
        <span class="text-sm text-red-600"></span>
    </div>
    <label for="email" class="text-sm font-medium">E-mail <span class="text-red-600">*</span> </label>
    <div>
        <input type="text" name="email" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Email" value="{{ old('email') }}">
        <span class="text-sm text-red-600"></span>
    </div>

    <label for="contact" class="text-sm font-medium">Phone <span class="text-red-600">*</span> </label>
    <div>
        <input type="tel" name="contact" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Contact Number" value="{{ old('contact') }}">
        <span class="text-sm text-red-600"></span>
    </div>

    <label for="password" class="text-sm font-medium">Password<span class="text-red-600">*</span> </label>
    <div>
        <input type="password" name="password" class="border rounded-md w-full px-4 py-2 text-sm mb-2" placeholder="Enter Password" value="">
        <span class="text-sm text-red-600"></span>
    </div>

    <label for="gender" class="text-sm font-medium">Gender<span class="text-red-600">*</span></label>
    <div class="flex flex-row gap-2 items-center">
        <input type="radio" name="gender" value="Male">Male
        <input type="radio" name="gender" value="Female">Female
        <input type="radio" name="gender" value="other">Other
        <span class="text-sm text-red-600"></span>

    </div>

    <label for="address" class="text-sm font-medium">Address <span class="text-red-600">*</span> </label>
    <div>
        <textarea name="address" id="address" class="border rounded-md w-full px-4 py-2 text-sm mb-2" placeholder="Enter Address" rows="3" cols="15">{{ old('address') }}</textarea>
        <span class="text-sm text-red-600"></span>

    </div>

    <label for="country" class="text-sm font-medium">Country<span class="text-red-600">*</span> </label>
     <select name="country" id="country">
        <option selected disabled>Select</option>
        @foreach($countries as $country)
        <option value="{{ $country->id }}">{{ $country->name }}</option>
        @endforeach
     </select>

    <label for="profile" class="text-sm font-medium">Profile <span class="text-red-600">*</span> </label>
    <div class="pb-4">
        <input type="file" name="profile" id="profile">
        <span class="text-sm text-red-600"></span>
    </div>
</div>
<button type="submit" name="register" id="register" class="bg-blue-800 text-white w-full  px-4 py-2  rounded-md">SignUp</button>

<footer>
    <p class="text-lg font-normal text-center">Already a user? <a href="{{ route('login') }}" class="text-blue-800 font-medium">Login here</a></p>
</footer>


</form>
</div>
</div>

@endsection