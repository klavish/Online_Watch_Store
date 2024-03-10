@extends('admin.layout')
@section('content')
<main>
<h1 class="mt-4">Edit Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>

        </ol>
      
<div class="flex items-center justify-center">
    @include('flash_data')
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
    </div>
    <div>
        <div>
            <img src="{{ asset('profiles') . '/'. $user->profile }}" width="100px" height="100px" alt="user image">
        </div>
        <form method="POST" action="{{ route('admin_user_profile_update', ['id' => $user->id])}}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <label for="profile">Profile</label>
            <div>
                <input type="file" name="profile" id="profile">
            </div>
            <button type="submit" name="update" id="update">Update</button>
        </form>
    </div>
    <div>

        <form method="POST" action="{{ route('admin_user_update', ['id' => $user->id])}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <label for="fname" class="text-sm font-medium">First Name<span class="text-red-600">*</span></label>
                <div>
                    <input type="text" name="fname" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter First Name" value="{{ $user->fname }}">
                    <span class="text-sm text-red-600"></span>
                </div>
                <label for="lname" class="text-sm font-medium">Last Name<span class="text-red-600">*</span></label>
                <div>
                    <input type="text" name="lname" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Last Name" value="{{ $user->lname }}">
                    <span class="text-sm text-red-600"></span>
                </div>
                <label for="email" class="text-sm font-medium">E-mail <span class="text-red-600">*</span> </label>
                <div>
                    <input type="text" name="email" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Email" value="{{ $user->email }}">
                    <span class="text-sm text-red-600"></span>
                </div>

                <label for="contact" class="text-sm font-medium">Phone <span class="text-red-600">*</span> </label>
                <div>
                    <input type="tel" name="contact" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Contact Number" value="{{ $user->contact }}">
                    <span class="text-sm text-red-600"></span>
                </div>

                <label for="gender" class="text-sm font-medium">Gender<span class="text-red-600">*</span></label>
                <div class="flex flex-row gap-2 items-center">
                    <input type="radio" name="gender" value="Male" @if($user->gender == 'Male'){{ 'checked' }} @endif>Male
                    <input type="radio" name="gender" value="Female" @if($user->gender == 'Female'){{ 'checked' }}@endif>Female
                    <input type="radio" name="gender" value="other" @if($user->gender == 'Other'){{ 'checked' }} @endif>Other
                    <span class="text-sm text-red-600"></span>

                </div>

                <label for="role_id" class="text-sm font-medium">Role<span class="text-red-600">*</span></label>
                <div class="flex flex-row gap-2 items-center">
                    <input type="radio" name="role_id" value="1" @if($user->role_id == '1')'{{ 'checked' }} @endif>Admin
                    <input type="radio" name="role_id" value="0" @if($user->role_id == '0'){{ 'checked' }}@endif>User
                    <span class="text-sm text-red-600"></span>

                </div>

                <label for="address" class="text-sm font-medium">Address <span class="text-red-600">*</span> </label>
                <div>
                    <textarea name="address" id="address" class="border rounded-md w-full px-4 py-2 text-sm mb-2" placeholder="Enter Address" rows="3" cols="15">{{ $user->address }}</textarea>
                    <span class="text-sm text-red-600"></span>

                </div>

                <label for="country" class="text-sm font-medium">Country<span class="text-red-600">*</span> </label>
                <select name="country" id="country">
                    <option selected disabled>Select</option>
                    @foreach($countries as $country)
                    <option value="{{ $country->id }}" @if($user->country == $country->id) {{ 'selected' }} @endif>{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" name="update" id="update" class="bg-blue-800 text-white w-full  px-4 py-2  rounded-md">Update</button>
        </form>
    </div>
</div>
</main>
@endsection