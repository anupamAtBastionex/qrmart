<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::getAllProduct();
        // return $products;
        return view('backend.product.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand=Brand::get();
        $category=Category::where('is_parent',1)->get();
        // return $category;
        return view('backend.product.create')->with('categories',$category)->with('brands',$brand);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
           // 'photo'=>'string|required',
            'size'=>'nullable',
            'color'=>'nullable',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'brand_id'=>'nullable|exists:brands,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'is_featured'=>'sometimes|in:1',
            'is_under_deal'=>'sometimes|in:1',
            'status'=>'required|in:active,inactive',
            'condition'=>'required|in:default,new,hot',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric',
            'google_category'=>'nullable',
            'faker_older_sold'=>'nullable',
            'rank'=>'nullable',
        ]);

        $data   =   $request->all();
        //print_r($data);die;
        $slug   =   Str::slug($request->title);
        $count  =   Product::where('slug',$slug)->count();
        if($count>0)
        {
            $slug   =   $slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']           =   $slug;
        $data['is_featured']    =   $request->input('is_featured',0);
        $data['is_under_deal']  =   $request->input('is_under_deal',0);
        $size                   =   $request->input('size');
        if($size){
            $data['size']       =   implode(',',$size);
        }
        else{
            $data['size']       =   '';
        }

        if($request->hasFile('photo'))
        {
            $image          =   $request->file('photo');
            $filename       =   'FE_'.uniqid() . '_' . str_replace(' ', '', $image->getClientOriginalName());
            $image->storeAs('public/photos/product/', $filename);
            $fullUrl        = url(env('APP_URL').'/storage/app/public/photos/product/'.$filename);
            $data['photo']  = $fullUrl;
          //  DB::table('product_images')->where('product_id', $id)->update(['photo' => $filename]);
        }

        // return $size;
        // return $data;
        $status=Product::create($data);
      ///  print_r($status->id);die;
        if($status)
        {
            $imgArr = [];
            if ($request->hasFile('images'))
            {
                foreach ($request->file('images') as $image)
                {
                    $filename = uniqid() . '_' . $image->getClientOriginalName();
                    $image->storeAs('public/photos/'.$status->id.'/', $filename);
                    $imgArr[] = ['product_id' => $status->id, 'image' => $filename];
                }
                DB::table('product_images')->insert($imgArr);
            }
            request()->session()->flash('success','Product added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand      =   Brand::get();
        $product    =   Product::findOrFail($id);
        $category   =   Category::where('is_parent',1)->get();
        $items      =   Product::where('id',$id)->get();
        $images     =   DB::table('product_images')->where('product_id', $id)->get();

        // return $items;
        return view('backend.product.edit')->with('product',$product)
                    ->with('brands',$brand)
                    ->with('categories',$category)
                    ->with('items',$items)
                    ->with('images',$images);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product=Product::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            //'photo'=>'string|required',
            'size'=>'nullable',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'is_featured'=>'sometimes|in:1',
            'is_under_deal'=>'sometimes|in:1,0',
            'brand_id'=>'nullable|exists:brands,id',
            'status'=>'required|in:active,inactive',
            'condition'=>'required|in:default,new,hot',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric'
        ]);

        $data=$request->all();
        $data['is_featured']    =   $request->input('is_featured',0);
        $data['is_under_deal']  =   $request->input('is_under_deal',0);
        //print_r( $data['is_under_deal']);die;
        $size=$request->input('size');
        if($size){
            $data['size']       =   implode(',',$size);
        }
        else{
            $data['size']       =   '';
        }

        if($request->hasFile('photo'))
        {
            $image          =   $request->file('photo');
            $filename       =   'FE_'.uniqid() . '_' . str_replace(' ', '', $image->getClientOriginalName());
            $image->storeAs('public/photos/'.$id.'/', $filename);
            $fullUrl        = url(env('APP_URL').'/storage/app/public/photos/'.$id.'/'.$filename);
            $data['photo']  = $fullUrl;
          //  DB::table('product_images')->where('product_id', $id)->update(['photo' => $filename]);
        }
        // return $data;
        $status =   $product->fill($data)->save();
        if($status)
        {
            $imgArr = [];
            if ($request->hasFile('images'))
            {
                foreach ($request->file('images') as $image)
                {
                    $filename = uniqid() . '_' . $image->getClientOriginalName();
                    $image->storeAs('public/photos/'.$id.'/', $filename);
                    $imgArr[] = ['product_id' => $id, 'image' => $filename];
                }
                DB::table('product_images')->insert($imgArr);
            }
            request()->session()->flash('success','Product updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $status=$product->delete();

        if($status){
            request()->session()->flash('success','Product deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting product');
        }
        return redirect()->route('product.index');
    }

    public function deleteImage($productId, $imageId)
    {
        print_r($productId);die;
        // $product=Product::findOrFail($id);
        // $status=$product->delete();

        // if($status){
        //     request()->session()->flash('success','Product deleted');
        // }
        // else{
        //     request()->session()->flash('error','Error while deleting product');
        // }
        // return redirect()->route('product.index');
    }



}
