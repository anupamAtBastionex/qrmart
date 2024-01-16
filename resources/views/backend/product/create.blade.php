@extends('backend.layouts.master')

@section('main-content')
<style>
    #image-preview img
    {
        width:100px !important;
        height: 100px !important;
    }
    .img-div{
        width: 150px;
    display: inline-block;
    }
</style>
<div class="card">
    <h5 class="card-header">Add Product
        <a href="{{ url('admin/product') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Back To Product List"><i class="fas fa-arrow-left"></i> Back</a>
    </h5>
    <div class="card-body">
      <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="cat_id">Category <span class="text-danger">*</span></label>
            <select name="cat_id" id="cat_id" class="form-control">
                <option value="">--Select any category--</option>
                @foreach($categories as $key=>$cat_data)
                    <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group d-none" id="child_cat_div">
            <label for="child_cat_id">Sub Category</label>
            <select name="child_cat_id" id="child_cat_id" class="form-control">
                <option value="">Select any category</option>
                  {{-- @foreach($parent_cats as $key=>$parent_cat)
                    <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
                @endforeach--}}
            </select>
        </div>
        <div class="form-group">
            <label for="google_category">Google Category</label>
            <input id="google_category" type="text" name="google_category" placeholder="Enter Google Category"  value="{{old('google_category')}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="brand_id">Brand</label>
            <select name="brand_id" class="form-control">
                <option>Select Brand</option>
               @foreach($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->title}}</option>
               @endforeach
            </select>
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
            <label for="code">Product Code</label>
            <input id="code" type="text" name="code" placeholder="Enter title"  value="{{old('code')}}" class="form-control">
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
          <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
          @error('summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="is_featured">Is Featured</label><br>
          <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes
        </div>

        <div class="form-group">
          <label for="price" class="col-form-label">Price(AED) <span class="text-danger">*</span></label>
          <input id="price" type="number" name="price" placeholder="Enter price"  value="{{old('price')}}" class="form-control">
          @error('price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="discount" class="col-form-label">Discount(%)</label>
          <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount"  value="{{old('discount')}}" class="form-control">
          @error('discount')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="size">Size</label>
          <select name="size[]" class="form-control selectpicker"  multiple data-live-search="true">
              <option value="">Select any size</option>
              <option value="S">Small (S)</option>
              <option value="M">Medium (M)</option>
              <option value="L">Large (L)</option>
              <option value="XL">Extra Large (XL)</option>
              <option value="2XL">Double Extra Large (2XL)</option>
              {{-- <option value="7US">7 US</option>
              <option value="8US">8 US</option>
              <option value="9US">9 US</option>
              <option value="10US">10 US</option>
              <option value="11US">11 US</option>
              <option value="12US">12 US</option>
              <option value="13US">13 US</option> --}}
          </select>
        </div>
        <div class="form-group">
            <label for="color">Color</label>
            <input type="text" id="color" name="color"  placeholder="Red,Green,Blue" value="{{old('color')}}" class="form-control">
        </div>
        <div class="form-group">
          <label for="condition">Condition</label>
          <select name="condition" class="form-control">
              <option value="">Select Condition</option>
              <option value="default">Default</option>
              <option value="new">New</option>
              <option value="hot">Hot</option>
          </select>
        </div>

        <div class="form-group">
          <label for="stock">Quantity <span class="text-danger">*</span></label>
          <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity"  value="{{old('stock')}}" class="form-control">
          @error('stock')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        {{-- <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-secondary text-white">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div> --}}

        <div class="form-group">
            <label for="inputPhoto" class="col-form-label">Featured Image <span class="text-danger">*</span></label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="photo" name="photo">
                <label class="custom-file-label" for="images">Choose Image</label>
            </div>
            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                @error('photo')
                <span class="text-danger">{{$message}}</span>
                @enderror
        </div>
        <div class="form-group">
            <label for="inputPhoto" class="col-form-label">More Images</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="images" name="images[]" multiple accept="image/*" onchange="previewImages()">
                <label class="custom-file-label" for="images">Choose images</label>
            </div>
            <div class="mt-3">
                <div id="image-preview">
                    @if(!empty($images))
                        @foreach ($images as $image)
                        <div class="img-div">
                            @php
                                $fullUrl = url(env('APP_URL').'/storage/app/public/photos/'.$product->id.'/'.$image->image);
                                 $deleteUrl = route('delete.image', ['productId' => $product->id, 'imageId' => $image->id]);
                            @endphp
                                <img src="{{ $fullUrl }}" class="img-rounded m-2">
                                <button type="button" class="delete-button" data-delete-url="{{ $deleteUrl }}" onclick="deleteImage(this)">X</button>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="stock">Fake Order Sold</label>
            <input id="fake_older_sold" type="number" name="fake_older_sold" placeholder="Enter Here"  value="{{old('fake_older_sold')}}" class="form-control">
            @error('fake_older_sold')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="stock">Rank</label>
            <input id="quantity" type="number" name="rank" min="0" placeholder="Enter Here"  value="{{old('rank')}}" class="form-control">
            @error('fake_older_sold')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
            <label for="is_under_deal" class="col-form-label">Is Under Deal? &nbsp;&nbsp;
                <input type="checkbox" class="form-control-label" name='is_under_deal' id='is_under_deal' value='1'>
            </label>
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
      $('#summary').summernote({
        placeholder: "Write short description.....",
          tabsize: 2,
          height: 100
      });
    });

    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write detail description.....",
          tabsize: 2,
          height: 150
      });
    });
    // $('select').selectpicker();

</script>

<script>
  $('#cat_id').change(function(){
    var cat_id=$(this).val();
    // alert(cat_id);
    if(cat_id !=null){
      // Ajax call
      $.ajax({
        url:"/admin/category/"+cat_id+"/child",
        data:{
          _token:"{{csrf_token()}}",
          id:cat_id
        },
        type:"POST",
        success:function(response){
          if(typeof(response) !='object'){
            response=$.parseJSON(response)
          }
          // console.log(response);
          var html_option="<option value=''>----Select sub category----</option>"
          if(response.status){
            var data=response.data;
            // alert(data);
            if(response.data){
              $('#child_cat_div').removeClass('d-none');
              $.each(data,function(id,title){
                html_option +="<option value='"+id+"'>"+title+"</option>"
              });
            }
            else{
            }
          }
          else{
            $('#child_cat_div').addClass('d-none');
          }
          $('#child_cat_id').html(html_option);
        }
      });
    }
    else{
    }
  })
</script>

<script>
    function previewImages() {
        var preview = document.getElementById('image-preview');
        preview.innerHTML = '';

        var files = document.getElementById('images').files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onload = function (e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail', 'm-2');
                preview.appendChild(img);
            };

            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
