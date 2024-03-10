@extends('admin.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Brands</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{ route('admin_home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('brands.index') }}">Brands</a></li>

        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Add Brand
            </div>

            <div class="card-body">
                @include('flash_data')
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
                    <h1 class="font-semibold text-xl text-center">Add Brand Form</h1>
                    <form class="bg-slate-100 flex flex-col justify-center px-4 py-6 w-1/2" name="registration" enctype="multipart/form-data" method="post" action="{{ route('brands.store') }}">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <label for="name" class="text-sm font-medium">Name<span class="text-red-600">*</span></label>
                            <div>
                                <input type="text" name="name" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter  Name" value="{{ old('name') }}">
                                <span class="text-sm text-red-600"></span>
                            </div>

                            <label for="description" class="text-sm font-medium">Description <span class="text-red-600">*</span> </label>
                            <div>
                                <textarea name="description" id="description" class="border rounded-md w-full px-4 py-2 text-sm mb-2" placeholder="Enter Description" rows="3" cols="15">{{ old('description') }}</textarea>
                                <span class="text-sm text-red-600"></span>

                            </div>

                            <label for="image" class="text-sm font-medium">Image <span class="text-red-600">*</span> </label>
                            <div class="pb-4">
                                <input type="file" name="image" id="image">
                                <span class="text-sm text-red-600"></span>
                            </div>
                        </div>
                        <button type="submit" name="add" id="add" class="bg-blue-800 text-white w-full  px-4 py-2  rounded-md">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection