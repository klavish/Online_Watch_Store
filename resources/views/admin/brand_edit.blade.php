@extends('admin.layout')
@section('content')
<main>
<h1 class="mt-4">Edit Brand</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{ route('admin_home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Brands</li>

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
            <img src="{{ asset('brands') . '/'. $brand->image }}" width="100" alt="brand image">
        </div>
        <form method="POST" action="{{ route('admin_brand_image_change', ['id' => $brand->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <label for="image">Image</label>
            <div>
                <input type="file" name="image" id="image">
            </div>
            <button type="submit" name="update" id="update">Update</button>
        </form>
    </div>
    <div>

        <form method="POST" action="{{ route('brands.update', ['brand' => $brand->id])}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <label for="name" class="text-sm font-medium">First Name<span class="text-red-600">*</span></label>
                <div>
                    <input type="text" name="name" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Name" value="{{ $brand->name }}">
                    <span class="text-sm text-red-600"></span>
                </div>

               
                <label for="description" class="text-sm font-medium">Description<span class="text-red-600">*</span> </label>
                <div>
                    <textarea name="description" id="description" class="border rounded-md w-full px-4 py-2 text-sm mb-2" placeholder="Enter Description" rows="3" cols="15">{{ $brand->description }}</textarea>
                    <span class="text-sm text-red-600"></span>

                </div>

               
            </div>
            <button type="submit" name="update" id="update" class="bg-blue-800 text-white w-full  px-4 py-2  rounded-md">Update</button>
        </form>
    </div>
</div>
</main>
@endsection