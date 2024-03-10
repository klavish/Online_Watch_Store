@extends('layout_user')
@section('content')
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</header>
<!-- Filters -->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="card box">
            <h5 class="car-header">Filter By</h5>
            <div class="card-body">
                <form action="{{ route('product_list') }}" name="search_by_detail" method="get" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md m-1">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-select">
                                <option selected disabled>Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Children">Children</option>
                                <option value="Unisex">Unisex</option>

                            </select>
                        </div>
                        <div class="form-group col-md m-1">
                            <label for="price">Price</label>
                            <select name="price" id="price" class="form-select">
                                <option selected disabled>Select</option>
                                <option value="less_than_1500">Less than $1500</option>
                                <option value="between_1500_5k">$1500 - $5000</option>
                                <option value="between_5K_10k">$5000 - $10,000</option>
                                <option value="between_10k_30k">$10,000 - $30,000</option>
                                <option value="greater_than_30k">More than $30,000</option>

                            </select>
                        </div>

                        <div class="form-group col-md m-1">
                            <label for="color">Color</label>
                            <select name="color" id="color" class="form-select">
                                <option selected disabled>Select</option>
                                @foreach(\Illuminate\Support\Facades\Config::get('colors') as $value)
                                <option value="{{ $value }}">{{ $value}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md m-1">
                            <label for="function">Function</label>
                            <select name="function" id="function" class="form-select">
                                <option selected disabled>Select</option>
                                @foreach(\Illuminate\Support\Facades\Config::get('watch_functions') as $value)
                                <option value="{{ $value }}">{{ $value}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md m-1">
                            <label for="brand">Brand</label>
                            <select name="brand" id="brand" class="form-select">
                                <option selected disabled>Select</option>
                                @foreach($brands as $key => $value)
                                <option value="{{ $key }}">{{ Str::Of($value)->replace('_', ' ')->title()->value() }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md m-1">
                            <label for="sort_by">Sort By:</label>
                            <select name="sort_by" id="sort_by" class="form-select">
                                <option selected disabled>Select</option>
                                <option value="lower_to_higher">Price Lower To Higher</option>
                                <option value="higher_to_lower">Price Higher to Lower</option>
                                <option value="model_a_z">Model (A-Z)</option>
                                <option value="model_z_a">Model (Z-A)</option>
                            </select>
                        </div>

                    </div>
                    <div class="text-center mt-3">
                        <input type="submit" name="search" id="search" value="Search" class="btn btn-success btn-sm">
                        <input type="reset" name="reset_filters" id="" value="Clear Filter" class="btn btn-success btn-sm">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach($products as $product)
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Sale badge-->
                    @if(empty($product->sale_price) && $product->stock != 0)
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                    @elseif($product->stock ==0)
                    <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Out Of Stock</div>
                    @endif
                    <!-- Product image-->
                    <img class="card-img-top" src="{{ $product->image }}" alt="{{ $product->name }}" />
                    {{-- <img class="card-img-top" src="{{ url('/products') . '/' . $product->image }}" alt="{{ $product->name }}" />--}}

                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">{{ $product->product_name }}</h5>
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Product price-->
                            @if(empty($product->sale_price))
                            <span class="text-muted text-decoration-line-through">{{ '$' . $product->price }}</span>
                            {{ '$' . $product->sale_price }}
                            @endif
                            {{ '$' . $product->price }}

                        </div>
                    </div>
                    <!-- Product actions-->
                    <!-- <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                           <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                       </div> -->

                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route('product_info', ['product' => $product->product_code] )}}">View Product</a></div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Pagination  -->
            {!! $products->links() !!}
            <!-- <nav aria-label="pagination">
                <ul class="pagination">
                    <li class="page-item">
                        <a href="" class="page-link" aria-label="Previous">
                            <span aria-hidden="true">
                                <</span>
                        </a>
                    </li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item">
                        <a href="" class="page-link" aria-label="Next">
                            <span aria-hidden="true">></span>
                        </a>
                    </li>
                </ul>

            </nav> -->

        </div>
    </div>
</section>
@endsection
@section('CSS')

<style>
    .form-group {
        margin-bottom: 1rem;
    }

    .form-inline .form-control {
        display: inline-block;
        width: auto;
        vertical-align: middle;
    }

    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -5px;
        margin-left: -5px;
    }

    label {
        margin-bottom: 0.5rem;
    }
</style>
@endsection