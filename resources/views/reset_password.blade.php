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
    <h1 class="font-semibold text-xl text-center">Reset Password Form</h1>
    <form class="bg-slate-100 flex flex-col justify-center px-4 py-6 w-1/3 space-y-4" name="passreset" method="post" action="{{ route('reset_password_data') }}">
        @csrf
        <input type="hidden" value="{{ $email }}">
        <label for="password" class="text-sm font-medium">Password<span class="text-red-600">*</span> </label>
    <div>
        <input type="password" name="password" id="password" class="border rounded-md w-full px-4 py-2 text-sm mb-2" placeholder="Enter Password" value="">
        <span class="text-sm text-red-600"></span>
    </div>

    <label for="password_confirm" class="text-sm font-medium">Confirm Password<span class="text-red-600">*</span> </label>
    <div>
        <input type="password" name="password_confirm" id="password_confirm" class="border rounded-md w-full px-4 py-2 text-sm mb-2" placeholder="Confirm Password" value="">
        <span class="text-sm text-red-600"></span>
    </div>
        <button type="submit" name="reset_password" value="reset_password" class="bg-blue-800 text-white w-full px-4 py-2 rounded-md">Reset</button>
    </form>
</div>
@endsection