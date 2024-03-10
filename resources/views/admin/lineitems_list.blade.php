@extends('admin.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Lineitems</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{ route('admin_home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Lineitems</li>

        </ol>
      
        <div class="card mb-4">
            
            <div class="card-body">
                @include('flash_data')
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                           <th>Order id</th>
                            <th>User Name</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Price</th> 

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>Order id</th>
                            <th>User Name</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Price</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($orderData->lineitemsData as $lineitemData)
                        <tr>
                            <td>LV - {{ $lineitemData->order_id }}</td>           
                            <td>{{ $lineitemData->customerData->fname }}</td>
                            <td>{{ $lineitemData->productData->name }}</td>
                            <td>{{ $lineitemData->quantity }}</td> 
                            <td>{{ $lineitemData->price  }}</td>            
                            <td>{{ $lineitemData->total_price  }}</td>            
                 
                        </tr>
                       @endforeach 
                    </tbody>
                
                </table>
            </div>
        </div>
    </div>
</main>
@endsection