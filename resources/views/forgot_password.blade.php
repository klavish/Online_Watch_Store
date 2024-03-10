@extends('layout_user')
@section('content')
<div class="w-full h-full flex flex-col justify-center items-center">
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
    <h1 class="font-semibold text-xl text-center">Forgot Password Form</h1>
    <form class="bg-slate-100 flex flex-col justify-center px-4 py-6 w-1/3 space-y-4" name="login" method="post" action="{{ route('send_forgot_password_email') }}">
        @csrf
        <label for="email" class="text-sm font-medium">Email <span class="text-red-600">*</span></label>
        <div>
            <input class="border rounded-md w-full px-4 py-2 text-sm" type="text" name="email" id="email" placeholder="Enter your email">
            <span class="text-sm text-red-600"></span>
        </div>
        <button type="submit" name="forgot_pass_btn" value="forgot_pass_btn" class="bg-blue-800 text-white w-full px-4 py-2 rounded-md">Send Email</button>
    </form>
</div>
@endsection