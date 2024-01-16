<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Shipping;
use App\Models\Order;

use DB;
use App\Models\ProductImages;
use Illuminate\Support\Str;

class CustomController extends Controller
{
    public function deleteImage($productId, $imageId)
    {
        //echo "asdfasdfasdf";
        //print_r($productId);die;
        $product  = ProductImages::where('product_id', $productId)->where('id', $imageId)->first();
        if($product)
        {
            $product->delete();
            return "yes";
        }
        else
        {
            return "no";
        }
    }

    public function editOrder($orderId)
    {
        $order          =   Order::find($orderId);
        $products       =   Product::all();
        //print_r($products);die;
        return view('backend.order.edit-order')->with(['order'=>$order, 'products'=>$products]);
    }
    public function modifiedOrder(Request $request, $id)
    {
      //  dd($request->first_name);
        $order=Order::find($id);
        $this->validate($request,[
            // 'status'=>'required|in:new,confirm,delete,dispatched,return,waiting,delivered'
            'first_name'    =>'required|string',
            'last_name'     =>'required|nullable',
            'phone'         =>'required',
            'address1'      =>'required|string',
            'product_id'    =>'required|numeric',
            'shipping_id'   =>'required|numeric',
        ]);

      // print_r($request->all());die;

        $order_data                 =   Order::find($id);

        $order_data->first_name     =   $request->first_name;
        $order_data->last_name      =   $request->last_name;
        $order_data->phone          =   $request->phone;
        $order_data->address1       =   $request->address1;
       // $status=$order->save();

        $shipping                   =   Shipping::where('id', $request->shipping_id)->pluck('price');
        $product                    =   Product::where('id', $request->product_id)->first();

        $after_discount             =   ($product->price - ($product->price * $product->discount) / 100);
        $order_data->shipping_id    =   $request->shipping_id;
        $order_data->product_name   =   $product->title;
        $order_data->product_id     =   $product->id;
        $order_data->sub_total      =   $after_discount; //Helper::totalCartPrice();
        $order_data->quantity       =   $request->quantity; //Helper::cartCount();
        $after_quantity             =   $after_discount * $request->quantity;
        $order_data->total_amount   =   $after_quantity+$shipping[0]; //$after_discount+$shipping[0];

        //print_r($order_data);die;
        $status=$order_data->save();

      //  $status=$order->fill($data)->save();
        if($status){
            request()->session()->flash('success','Successfully updated order');
        }
        else{
            request()->session()->flash('error','Error while updating order');
        }
        return redirect()->route('order.index');
    }



}
