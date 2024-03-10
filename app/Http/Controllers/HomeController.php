<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){

        $startDate = Carbon::now()->firstOfMonth();
        $endDate = Carbon::now()->lastOfMonth();
        $products = Product::whereBetween('created_at', [$startDate, $endDate])->inRandomOrder()->limit(8)->get();
        return view('user_index', compact('products'));
    }

    public function productInfo(Request $request, Product $product){
       $relatedProducts = Product::where('gender', $product->gender)->where('function', $product->function)->inRandomOrder()->limit(4)->get();
        return view('product_view', compact('product', 'relatedProducts'));
    }

    public function productList(Request $request){
        $requestData = $request->all();
        $brands = Brands::pluck('name', 'id');
        $products = Product::query();
        if(isset($requestData['gender']) && !empty($requestData['gender'])){
            $products = $products->where('gender', $requestData['gender']);
        }
        if(isset($requestData['price']) && !empty($requestData['price'])){
            if($requestData['price'] == 'less_than_1500'){
                // $products = $products->where(function($query) use($requestData){
                //     $query->where('price', '<', 1500);
                //     $query->where('sale_price', '<', 1500);

                //});
                $products = $products->where('price', '<', 1500);
            }   elseif($requestData['price'] == 'between_1500_5k'){
                //    $products = $products->where(function($query) use($requestData){
                //     $query->whereBetween('price', [1500, 5000]);
                //     $query->orwhereBetween('sale_price', [1500, 5000]);

                // });
                $products = $products->whereBetween('price', [1500, 5000]);
            } elseif($requestData['price'] == 'between_5k_10k'){
            //     $products = $products->where(function($query) use($requestData){
            //      $query->whereBetween('price', [5000, 10000]);
            //      $query->orwhereBetween('sale_price', [5000, 10000]);

            //  });
             $products = $products->whereBetween('price', [5000, 10000]);
            }   elseif($requestData['price'] == 'between_10k_30k'){
        //     $products = $products->where(function($query) use($requestData){
        //      $query->whereBetween('price', [10000, 30000]);
        //      $query->orwhereBetween('sale_price', [10000, 30000]);

        //  });
         $products = $products->whereBetween('price', [1500, 5000]);
        } elseif($requestData['price'] == 'greater_than_30k'){
                $products = $products->where(function($query) use($requestData){
                 $query->where('price', '>', 30000);
                 $query->where('sale_price', '>', 30000);

             });
             $products = $products->where('price', '>', 30000);
        }
        }

        if(isset($requestData['color']) && !empty($requestData['color'])){
            $products = $products->where('color', $requestData['color']);
        } 

        if(isset($requestData['function']) && !empty($requestData['function'])){
            $products = $products->where('function', $requestData['function']);
        } 

        if(isset($requestData['brand']) && !empty($requestData['brand'])){
            $products = $products->where('brand_id', $requestData['brand']);
        }

        if(isset($requestData['sort_by']) && !empty($requestData['sort_by'])){
            if($requestData['sort_by'] =='lower_to_higher'){
                $products = $products->orderBy('price', 'ASC');
            }elseif($requestData['sort_by'] =='higher_to_lower'){
                $products = $products->orderBy('price', 'DESC');
            }elseif($requestData['sort_by'] =='model_a_z'){
                $products = $products->orderBy('name', 'ASC');
            }elseif($requestData['sort_by'] =='model_z_a'){
                $products = $products->orderBy('name', 'DESC');
            }

        }
        $products = $products->paginate(12);
        return view('product_list', compact('brands', 'products'));
    }
}
