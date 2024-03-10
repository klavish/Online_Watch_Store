@extends('admin.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Products</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{ route('admin_home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('product.index') }}">Brands</a></li>

        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Add Product
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
                    <h1 class="font-semibold text-xl text-center">Add Product Form</h1>
                    <form class="bg-slate-100 flex flex-col justify-center px-4 py-6 w-1/2" name="registration" enctype="multipart/form-data" method="post" action="{{ route('product.store') }}">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <label for="name" class="text-sm font-medium">Product Name<span class="text-red-600">*</span></label>
                            <div>
                                <input type="text" name="name" id="name" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Product Name" value="{{ old('name') }}">
                                <span class="text-sm text-red-600"></span>
                            </div>

                            <label for="price" class="text-sm font-medium">Price<span class="text-red-600">*</span></label>
                            <div>
                                <input type="text" name="price" id="price" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Price" value="{{ old('price') }}">
                                <span class="text-sm text-red-600"></span>
                            </div>

                            <label for="sale_price" class="text-sm font-medium">Sale Price<span class="text-red-600">*</span></label>
                            <div>
                                <input type="text" name="sale_price" id="sale_price" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Sale Price" value="{{ old('sale_price') }}">
                                <span class="text-sm text-red-600"></span>
                            </div>

                            <label for="color" class="text-sm font-medium">Color<span class="text-red-600">*</span></label>
                            <div>
                                <input type="text" name="color" id="color" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Sale Price" value="{{ old('color') }}">
                                <span class="text-sm text-red-600"></span>
                            </div>

                            <label for="brand_id" class="text-sm font-medium">Brand<span class="text-red-600">*</span></label>
                            <select name="brand_id" id="brand_id">
                                <option selected disabled>Select</option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>

                            <label for="product_code" class="text-sm font-medium">Product Code<span class="text-red-600">*</span></label>
                            <div>
                                <input type="text" name="product_code" id="product_code" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Product Code" value="{{ old('product_code') }}">
                                <span class="text-sm text-red-600"></span>
                            </div>


                            <label for="gender" class="text-sm font-medium">Gender<span class="text-red-600">*</span></label>
                            <div class="flex flex-row gap-2 items-center">
                                <input type="radio" name="gender" value="Male">Male
                                <input type="radio" name="gender" value="Female">Female
                                <input type="radio" name="gender" value="Children">Children
                                <input type="radio" name="gender" value="Unisex">Unisex
                                <span class="text-sm text-red-600"></span>

                            </div>

                            
                            <label for="function" class="text-sm font-medium">Function<span class="text-red-600">*</span></label>
                            <select name="function" id="function">
                                <option selected disabled>Select</option>
                                @foreach(\Illuminate\Support\Facades\Config::get('watch_functions') as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach 
                            </select>

                            <label for="stock" class="text-sm font-medium">Stock<span class="text-red-600">*</span></label>
                            <div>
                                <input type="number" name="stock" id="stock" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Stock" value="{{ old('stock') }}">
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
                        <button type="submit" name="add_product" id="add_product" class="bg-blue-800 text-white w-full  px-4 py-2  rounded-md">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection