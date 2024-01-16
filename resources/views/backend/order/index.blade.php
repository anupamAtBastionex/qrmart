@extends('backend.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Order Lists</h6>
    </div>
    <div class="card-body">
    <p>
        <strong> Filter By: </strong>
        <a href="{{ url('admin/order/') }}?status=new" id="btn-status" class="btn btn-primary">NEW</a>
        <a href="{{ url('admin/order/') }}?status=confirm" id="btn-status" class="btn btn-info">CONFIRM</a>
        <a href="{{ url('admin/order/') }}?status=dispatched" id="btn-status" class="btn btn-warning">DISPATCHED</a>
        <a href="{{ url('admin/order/') }}?status=waiting" id="btn-status" class="btn btn-warning">WAITING</a>
        <a href="{{ url('admin/order/') }}?status=delivered" id="btn-status" class="btn btn-success">DELIVERED</a>
        <a href="{{ url('admin/order/') }}?status=delete" id="btn-status" class="btn btn-danger">DELETE</a>
        <a href="{{ url('admin/order/') }}?status=return" id="btn-status" class="btn btn-danger">RETURN</a>
        <a href="{{ url('admin/order/') }}?status=" id="btn-status" class="btn btn-dark">ALL</a>
        <a href="{{ url('admin/order/') }}?status=dup" id="btn-status" class="btn btn-warning">DUPLICATE</a>
    </p>
      <div class="table-responsive">
        @if(count($orders)>0)
        <table class="table table-bordered table-hover" id="order-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Order No.</th>
              <th>Product Name</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Qty.</th>
              <th>Charge</th>
              <th>Total</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php $counter = 0;  @endphp
            @foreach($orders as $order)
            @php

                $shipping_charge=DB::table('shippings')->where('id',$order->shipping_id)->pluck('price');
            @endphp
                <tr @if(isset($_GET['status']) && $_GET['status'] == 'dup') class="bg-secondary text-white" @endif>
                    <td>{{++$counter}}</td>
                    @if(isset($_GET['status']) && $_GET['status'] == 'dup')
                        <td>
                            <a href="{{ url('admin/order/') }}?status=dup&phone={{ $order->phone }}" class="text-white" data-toggle="tooltip" title="View duplicate records" data-placement="bottom">{{ $order->order_number }}</a>
                        </td>
                    @else
                        <td>{{$order->order_number}}</td>
                    @endif

                    <td>{{$order->product_name}}</td>
                    <td>{{$order->first_name}} {{$order->last_name}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>@foreach($shipping_charge as $data) AED {{number_format($data,2)}} @endforeach</td>
                    <td>AED {{number_format($order->total_amount,2)}}</td>
                    <td>
                        {{-- 'new',confirm,'delete',dispatched,return,waiting,'delivered' --}}
                        @if($order->status=='new')
                          <span class="badge badge-primary">NEW</span>
                        @elseif($order->status=='confirm')
                          <span class="badge badge-info">Confirm</span>
                        @elseif($order->status=='dispatched')
                          <span class="badge badge-warning">Dispatched</span>
                        @elseif($order->status=='waiting')
                        <span class="badge badge-warning">Waiting</span>
                        @elseif($order->status=='delivered')
                          <span class="badge badge-success">Delivered</span>
                        @elseif($order->status=='delete')
                          <span class="badge badge-danger">Delete</span>
                        @elseif($order->status=='return')
                        <span class="badge badge-danger">Return</span>
                        @else
                          <span class="badge badge-danger">{{$order->status}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('order.show',$order->id)}}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="view" data-placement="bottom"><i class="fas fa-eye"></i></a>
                        <a href="{{route('order.edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Change Status" data-placement="bottom"><i class="fas fa-toggle-on"></i></a>
                        <a href="{{route('order.edit-order',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Edit Order Detail" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{route('order.destroy',[$order->id])}}">
                          @csrf
                          @method('delete')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$orders->links()}}</span>
        @else
          <h6 class="text-center">No orders found!!! Please order some products</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>

      $('#order-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[8]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){

        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
          })
      })
  </script>
@endpush
