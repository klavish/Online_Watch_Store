<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){

        $orders = Order::with('customerData')->get();
        return view('admin.orders_list', compact('orders'));
    }

    public function changeOrderStatus(Request $request, $id){

        Order::where('id', $id)->update(['status' => $request->status ?? null]);
        return redirect()->back()->with('success', 'Order Status Changed Successfully');
    }

    public function getLineItems(Request $request, $id){

        $orderData = Order::where('id', $id)->with('lineitemsData')->first();
        return view('admin.lineitems_list', compact('orderData'));
    }
}
