@extends('layout_user')
@section('content')
<div class="container">
    <div class="row m-t-10">
        <div class="col-md-12 col-lg-12  col-xl-12">
         <div class="card m-b-30">
          <div class="card-header">
            <h5 class="card-title">Cart</h5>
        </div>
        <div class="card-body">
              @include('flash_data')
            <div class="row justify-content-center">
             <div class="col-lg-10 col-xl-8">
               <div class="cart-container">
                <div class="cart-head">
                    <div class="table-responsive">
                       <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Product</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{ route('cart.store')}}" method="post">
                                @csrf
                           @foreach($cartData as $value)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    <img src="{{ $value->getProductData->image }}" alt="product" class="img-fluid" width="35" aria-multiline="product"></td>
                                <td>{{ $value->getProductData->name }}</td>
                                <td>
                                    <div class="form-group mb-8">
                                     <input type="hidden" name="cart[]" id="cartQty{{ $loop->iteration }}" value="{{ $value->id }}" class="form-control cart-qty">
                                     <input type="number" name="cartQty[]" id="cartQty{{ $loop->iteration }}" min="0" value="{{ $value->quantity }}" class="form-control cart-qty">
                                    
                                    </div>
                                </td>
                                <td>$ {{ !empty($value->getProductData->sale_price) ? $value->getProductData->sale_price : $value->getProductData->price }}</td>
                                <td class="text-right">${{ !empty($value->getProductData->sale_price) ? ($value->getProductData->sale_price *  $value->quantity) : ($value->getProductData->price *  $value->quantity) }}</td>
                            </tr>
                            @endforeach
                          
                        </tbody>
                       </table>
                    </div>
                </div>
                <div class="cart-body">
                    <div class="row">
                        <div class="col-md-12 order-2 order-lg-1 col-lg-5 col-xl-6">
                            <div class="order-note">
                                    <div class="form-group">
                                        <label for="specialNotes">Special Note</label>
                                        <textarea name="specialNotes" id="specialNotes" cols="30" rows="4">{{ $user->commentData->comment ?? null }}</textarea>
                                    </div>
                            </div>

                        </div>
                        <div class="col-md-12 order-1 order-lg-2col-lg-7 col-xl-6">
                            <div class="order-total table-responsive">
                             <table class="table table-boderless text-right">
                               <tr>
                                <td>Sub Total</td>
                                <td>${{ $subtotal }}</td>
                               </tr>
                               <tr>
                                <td>Shipping</td>
                                <td>${{ $shipping }}</td>
                               </tr>
                               <tr>
                                <td>Tax({{ $tax .'%' }})</td>
                                <td>$ {{ $taxAmount }}</td>
                               </tr>
                               <tr>
                                <td class="f-w-7" font-18><h4>Amount :</h4></td>
                                <td class="f-w-7" font-18><h4>${{ $total }}</h4></td>

                               </tr>
                             </tbody>
                             </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="cart-footer text-right">
                    <button type="submit" class="btn btn-outline-primary my-1"><i class="fa fa-pencil" aria-hidden="true"></i>Update Cart</button>
                    </form>
                    <a href="{{ route('store_order') }}" class="btn btn-outline-success my-1"><i class="fa fa-credit-card-alt" aria-hidden="true">Proceed To Checkout</a>
                </div>
               </div>
             </div>
            </div>
          </div>
         </div>
        </div>
    </div>
</div>      
@endsection