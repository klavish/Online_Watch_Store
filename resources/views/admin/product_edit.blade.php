@extends('admin.layout')
@section('content')
<main>
    <h1 class="mt-4">Edit Product</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="{{ route('admin_home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Products</li>

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
                <img src="{{ url('products') . '/'. $product->image }}" width="100" alt="product image">
            </div>
            <form method="POST" action="{{ route('admin_product_image_change', ['id' => $product->id])}}" enctype="multipart/form-data">
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

            <form method="POST" action="{{ route('product.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <label for="name" class="text-sm font-medium">Product Name<span class="text-red-600">*</span></label>
                    <div>
                        <input type="text" name="name" id="name" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Product Name" value="{{ $product->name }}">
                        <span class="text-sm text-red-600"></span>
                    </div>

                    <label for="price" class="text-sm font-medium">Price<span class="text-red-600">*</span></label>
                    <div>
                        <input type="text" name="price" id="price" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Price" value="{{ $product->price }}">
                        <span class="text-sm text-red-600"></span>
                    </div>

                    <label for="sale_price" class="text-sm font-medium">Sale Price<span class="text-red-600">*</span></label>
                    <div>
                        <input type="text" name="sale_price" id="sale_price" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Sale Price" value="{{ $product->sale_price }}">
                        <span class="text-sm text-red-600"></span>
                    </div>

                    <label for="color" class="text-sm font-medium">Color<span class="text-red-600">*</span></label>
                    <div>
                        <input type="text" name="color" id="color" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Sale Price" value="{{ $product->color }}">
                        <span class="text-sm text-red-600"></span>
                    </div>

                    <label for="brand_id" class="text-sm font-medium">Brand<span class="text-red-600">*</span></label>
                    <select name="brand_id" id="brand_id">
                        <option selected disabled>Select</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" @if($brand->id == $product->brand_id) {{ 'selected' }} @endif>{{ $brand->name }}</option>
                        @endforeach
                    </select>

                    <label for="product_code" class="text-sm font-medium">Product Code<span class="text-red-600">*</span></label>
                    <div>
                        <input type="text" name="product_code" id="product_code" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Product Code" value="{{ $product->product_code }}">
                        <span class="text-sm text-red-600"></span>
                    </div>


                    <label for="gender" class="text-sm font-medium">Gender<span class="text-red-600">*</span></label>
                    <div class="flex flex-row gap-2 items-center">
                        <input type="radio" name="gender" value="Male" @if($product->gender == 'Male'){{ 'checked' }} @endif>Male
                        <input type="radio" name="gender" value="Female" @if($product->gender == 'Female'){{ 'checked' }}@endif>Female
                        <input type="radio" name="gender" value="Children" @if($product->gender == 'Children'){{ 'checked' }} @endif>Children
                        <input type="radio" name="gender" value="Unisex" @if($product->gender == 'Unisex'){{ 'checked' }} @endif>Unisex
                        <span class="text-sm text-red-600"></span>
                    </div>


                    <label for="function" class="text-sm font-medium">Function<span class="text-red-600">*</span></label>
                    <select name="function" id="function">
                        <option selected disabled>Select</option>
                        @foreach(\Illuminate\Support\Facades\Config::get('watch_functions') as $value)
                        <option value="{{ $value }}" @if($value == $product->function){{ 'selected' }} @endif>{{ $value }}</option>
                        @endforeach
                    </select>

                    <label for="stock" class="text-sm font-medium">Stock<span class="text-red-600">*</span></label>
                    <div>
                        <input type="number" name="stock" id="stock" class="border rounded-md w-full px-4 py-2 text-sm" placeholder="Enter Stock" value="{{ $product->stock }}">
                        <span class="text-sm text-red-600"></span>
                    </div>

                    <label for="description" class="text-sm font-medium">Description <span class="text-red-600">*</span> </label>
                    <div>
                        <textarea name="description" id="description" class="border rounded-md w-full px-4 py-2 text-sm mb-2" placeholder="Enter Description" rows="3" cols="15">{{ $product->description }}</textarea>
                        <span class="text-sm text-red-600"></span>

                    </div>


                </div>
                <button type="submit" name="update" id="update" class="bg-blue-800 text-white w-full  px-4 py-2  rounded-md">Update</button>
            </form>
        </div>
    </div>
</main>
@endsection