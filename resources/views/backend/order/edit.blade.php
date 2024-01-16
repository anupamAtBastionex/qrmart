@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="card">
  <h5 class="card-header">
    <a href="{{url('admin/order')}}" class=" btn btn-sm btn-primary shadow-sm float-right ml-3"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back </a>
    {{-- <a href="{{url('admin/order')}}" class="btn btn-info " style="width:100px; float:right"><i class="fa fa-arrow-left"></i> Back </a> --}}
    Order Edit</h5>
  <div class="card-body">
    <form action="{{route('order.update',$order->id)}}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="status">Status :</label>
        <select name="status" id="" class="form-control">
          <option value="new" {{($order->status=='delivered' || $order->status=="confirm" || $order->status=="delete" || $order->status=="dispatched") ? 'disabled' : ''}}  {{(($order->status=='new')? 'selected' : '')}}>New</option>
          <option value="waiting" {{($order->status=='delivered'|| $order->status=="delete") ? 'disabled' : ''}}  {{(($order->status=='waiting')? 'selected' : '')}}>Waiting</option>
          <option value="confirm" {{($order->status=='delivered'|| $order->status=="delete") ? 'disabled' : ''}}  {{(($order->status=='confirm')? 'selected' : '')}}>Confirm</option>
          <option value="dispatched" {{($order->status=='delivered'|| $order->status=="delete") ? 'disabled' : ''}}  {{(($order->status=='dispatched')? 'selected' : '')}}>Dispatched</option>
          <option value="delivered" {{($order->status=="delete") ? 'disabled' : ''}}  {{(($order->status=='delivered')? 'selected' : '')}}>Delivered</option>
          <option value="return" {{ (($order->status=='return' || $order->status=="delete")? 'selected' : '') }}>Return </option>
          <option value="delete" {{( $order->status=='delete' ) ? 'disabled' : ''}}  {{ (( $order->status=='delete' )? 'selected' : '')}}>Delete</option>
        </select>
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
