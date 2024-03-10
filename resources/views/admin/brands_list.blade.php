@extends('admin.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Brands</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item active">Brands</li>

        </ol>
      
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                All Brands
               <a href="{{ route('brands.create') }}" class="btn btn-outline-primary btn-sm float-end">+ Add Brand</a>
            </div>
 
            <div class="card-body">
                @include('flash_data')
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th> Name</th> 
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($brands as $brand)
                        <tr>
                            <td>{{ $brand->name  }}</td>
                            <td><img src="{{ url('brands') . '/' . $brand->image }}" alt="{{ $brand->name ?? 'Brand'}}" width="100"></td>
            
                            <td>
                            <a href="{{ route('brands.edit', ['brand' => $brand->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="{{ route('admin_change_brand_status', ['id' => $brand->id, 'status' => $brand->is_active == 1 ? 0 : 1]) }}" class="btn btn-sm btn-{{ $brand->is_active == 1 ? 'danger' : 'success' }}">{{ $brand->is_active == 1 ? 'Deactivate' : 'Activate' }}</a>
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