@extends('admin.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Products</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{ route('admin_home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Products</li>

        </ol>
      
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                All Products
               <a href="{{ route('product.create') }}" class="btn btn-outline-primary btn-sm float-end">+ Add Product</a>
            </div>
 
            <div class="card-body">
                @include('flash_data')
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Product Code</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Sale Price</th>
                            <th>Color</th>
                            <th>Brand</th>
                            <th>Gender</th>
                            <th>Function</th>
                            <th>Stock</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Product Code</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Sale Price</th>
                            <th>Color</th>
                            <th>Brand</th>
                            <th>Gender</th>
                            <th>Function</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->product_code  }}</td>
                            <td>{{ \Illuminate\Support\Str::title($product->name)  }}</td>            
                            <td>{{ $product->price  }}</td>            
                            <td>{{ $product->sale_price  }}</td>            
                            <td>{{ \Illuminate\Support\Str::title($product->color)  }}</td>            
                            <td>{{ \Illuminate\Support\Str::title($product->getbrandData->name)  }}</td>            
                            <td>{{ \Illuminate\Support\Str::title($product->gender)  }}</td>            
                            <td>{{ \Illuminate\Support\Str::title($product->function)  }}</td>            
                            <td>{{ $product->stock  }}</td>            

                            <td>
                            <a href="{{ route('product.edit', ['product' => $product->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="{{ route('admin_change_product_status', ['id' => $product->id, 'status' => $product->is_active == 1 ? 0 : 1]) }}" class="btn btn-sm btn-{{ $product->is_active == 1 ? 'danger' : 'success' }}">{{ $product->is_active == 1 ? 'Deactivate' : 'Activate' }}</a>
                            </td>
                            
                        </tr>
                       @endforeach 
                    </tbody>
                
                </table>
            </div>
        </div>
    </div>
</main>
@endsection