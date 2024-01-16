@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="card">

  <h5 class="card-header">
    <a href="{{url('admin/order')}}" class=" btn btn-sm btn-primary shadow-sm float-right ml-3"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back </a>
    {{-- <a href="{{url('admin/order')}}" class="btn btn-info " style="width:100px; float:right"><i class="fa fa-arrow-left"></i> Back </a> --}}
    Order Edit
  </h5>

  <div class="card-body">

    <form action="{{route('order.update-order',$order->id)}}" method="POST">
      @csrf
      @method('PATCH')

        <div class="form-group">
            <label for="inputTitle" class="col-form-label">First Name <span class="text-danger">*</span></label>
            <input id="inputTitle" type="text" name="first_name" placeholder="First Name"  value="{{ $order->first_name }}" class="form-control" required="">
        </div>
        <div class="form-group">
            <label for="inputTitle" class="col-form-label">Last Name </label>
            <input id="inputTitle" type="text" name="last_name" placeholder="Last Name"  value="{{ $order->last_name }}" class="form-control" required="">
        </div>
        <div class="form-group">
            <label for="status">Mobile</label>
            <input type="text" name="phone" class="form-control" aria-label="Small" placeholder="Mobile" value="{{ $order->phone }}" aria-describedby="inputGroup-sizing-sm" required="">
        </div>
        <div class="form-group">
            <label for="inputTitle" class="col-form-label">Address <span class="text-danger">*</span></label>
            <input id="inputTitle" type="text" name="address1" placeholder="Enter Address"  value="{{ $order->address1 }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="status">Product </label>
            <select name="product_id" class="form-control" required style="width: 100%">
                <option value="">Select Product</option>
                @foreach($products as $product)
                    <option value="{{$product->id}}"  @if($product->id == $order->product_id) {{ "selected" }} @endif class="shippingOption">{{$product->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="status">Shipping</label>
            @if(count(Helper::shipping())>0)
                <select name="shipping_id" class="form-control" required style="width: 100%">
                    <option value="">Select your address</option>
                    @foreach(Helper::shipping() as $shipping)
                        <option value="{{$shipping->id}}" class="shippingOption" @if($shipping->id == $order->shipping_id) {{ "selected" }} @endif data-price="{{$shipping->price}}">{{$shipping->type}}: {{$shipping->price}} AED</option>
                    @endforeach
                </select>
            @else
                <span>Free Delivery</span>
            @endif
        </div>
        <div class="form-group">
            <label for="inputTitle" class="col-form-label">Quantity <span class="text-danger">*</span></label>
            <input id="inputTitle" type="number" name="quantity" placeholder="Enter title"  value="{{ $order->quantity }}" class="form-control">
        </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
@endsection

@push('styles')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }

</style>
@endpush
