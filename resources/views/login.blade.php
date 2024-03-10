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
<div class="w-full h-full flex flex-col justify-center items-center">
<h1 class="font-semibold text-xl text-center">Login Form</h1>
    <form class="bg-slate-100 flex flex-col justify-center px-4 py-6 w-1/3 space-y-4" name="login" method="post" action="{{ route('authenticate') }}">
        @csrf
        <label for="email" class="text-sm font-medium">Email <span class="text-red-600">*</span></label>
        <div>
            <input class="border rounded-md w-full px-4 py-2 text-sm" type="text" name="email" id="email" placeholder="Enter your email">
            <span class="text-sm text-red-600"></span>
        </div>
        <label for="password" class="text-sm font-medium">Password <span class="text-red-600">*</span> </label>
        <div>
            <input type="password" name="password" class="border rounded-md w-full px-4 py-2 text-sm mb-2" placeholder="Enter Password">
            <span class="text-sm text-red-600"></span>
        </div>

        <button type="submit" name="user_login" value="user_login" class="bg-blue-800 text-white w-full px-4 py-2 rounded-md">Login</button>

        <footer>
            <p class="text-base font-normal text-center">Not Registered? <a href="{{ route('register') }}" class="text-blue-800 font-medium">Register here</a></p>
            <p class="text-base font-normal text-center">Forgot password? <a href="{{ route('forgot_password') }}" class="text-blue-800 font-medium">Reset Password</a></p>
        </footer>
    </form>
</div>
</div>
@endsection