@extends('backend.master');
@section('title')
Edit-product
@endsection
@section('productactive')
active
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('products.view') }}">Products</a></li>
                        <li class="breadcrumb-item active"> <a href="{{route('AddProduct')}}">Add a Product</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="col-md mx-auto">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">New Product</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('UpdateProduct') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        {{-- product field Start --}}

                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                placeholder="Product name" value="{{ $product->title }}" name="title">
                        </div>
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="row">
                            <div class=" col form-group">
                                <label for="thumbnail">Product Thumbnail </label>
                                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                    value="value=" {{ asset('thumb'.$product->title) }}"" id="thumbnailid"
                                    placeholder="thumbnail" name="thumbnail">
                            </div>
                            <div class="col form-group">
                                <label for="">Thumbnail Preview: <strong class="text-danger">**</strong></label><br>
                                @if (file_exists(public_path('thumb/'.$product->thumbnail)))
                                <img src="{{asset('thumb/'.$product->thumbnail)}}" alt="{{$product->title}}"
                                    width="100">
                                @else
                                <strong class="text-danger">Not Available</strong>
                                @endif
                            </div>
                        </div>
                        @error('thumbnail')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="category"> Category</label>
                                <select class="form-control @error('category_id') is-invalid @enderror"
                                    name="category_id" id="category_id">

                                    <option value="">Select</option>
                                    @foreach ($cats as $cat)

                                    <option @if ($product->category_id == $cat->id) selected @endif
                                        value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('category')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group col-6">
                                <label for="subcategory_id"> Subcategory</label>
                                <select class="form-control @error('subcategory_id') is-invalid @enderror"
                                    name="subcategory_id" id="subcategory_id">
                                    <option value="">Select</option>
                                    @foreach ($scat as $scat)
                                    <option @if ($product->subcategory_id == $scat->id) selected @endif
                                        value="{{ $scat->id }}">{{ $scat->subcategory_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('subcategory_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="summery"> Summery </label>
                            <input type="text" class="form-control @error('summery') is-invalid @enderror"
                                value="{{ $product->summery }}" id="summery" placeholder="Summery" name="summery">
                        </div>
                        @error('summery')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group mb-4">
                            <label for="slug"> Description </label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                id="description" placeholder="Description">{{ $product->description }}</textarea>
                        </div>
                        @error('description')
                        <div class="alert alert-danger mb-4">{{ $message }}</div><br>
                        @enderror

                        {{-- product field end --}}

                        {{-- attribute field start here --}}

                        @foreach ($product->Atrribute as $key=> $attribute)
                        <div class="form-group">

                            <div class="row">
                                <input type="hidden" name="att_id[]" class="form-control" value="{{$attribute->id}}">
                                <div class="col form-group">
                                    <label for="">Image</label>
                                    <input type="file" name="image[]" class="form-control-file">
                                    @error('image[]')
                                    <div class="alert alert-danger font-size-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col form-group">
                                    <label for="">Image<strong class="text-danger">**</strong></label><br>
                                    @if (file_exists(public_path('images/' .$attribute->image)))
                                    <img src="{{asset('images/'.$attribute->image)}}" alt="{{$product->title}}"
                                        width="50">
                                    @else
                                    <strong class="text-danger">Not Available</strong>
                                    @endif
                                </div>
                                <div class="col form-group">
                                    <label for="color_id">Color</label>
                                    <select name="color_id[]" id="color_id" class="form-control">
                                        <option value>Select</option>
                                        @foreach ($colors as $color)
                                        <option @if ($attribute->color_id == $color->id) selected @endif
                                            value="{{$color->id}}">{{$color->color_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="size_id">Size</label>
                                    <select name="size_id[]" id="size_id" class="form-control">
                                        <option value>Select</option>
                                        @foreach ($sizes as $size)
                                        <option @if ($attribute->size_id == $size->id) selected @endif
                                            value="{{$size->id}}">{{$size->size_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('size_id[]')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col form-group">
                                    <label for="">Quantity</label>
                                    <input type="text" name="quantity[]" class="form-control"
                                        value="{{$attribute->quantity}}">
                                    @error('quantity[]')
                                    <div class="alert alert-danger font-size-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col form-group">
                                    <label for="">Price</label>
                                    <input type="text" name="regular_price[]" class="form-control"
                                        value="{{$attribute->regular_price}}">
                                    @error('regular_price[]')
                                    <div class="alert alert-danger font-size-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col form-group">
                                    <label for="">Sale</label>
                                    <input type="text" name="sale_price[]" class="form-control"
                                        value="{{$attribute->sale_price}}">
                                    @error('sale_price[]')
                                    <div class="alert alert-danger font-size-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Delete</label>
                                    <span>
                                        <a class="form-control"
                                            href="{{route('DeleteProductAttribute',$attribute->id)}}"><i
                                                class="text-danger fas fa-trash-alt"></i></a>
                                    </span>
                                </div>

                            </div>
                        </div>
                        @endforeach

                        {{-- attribute field start here --}}


                        <h3 class="mt-4 mb-4 text-center bg-blue"> <label class="text-white"> Add Attributes</label>
                        </h3>


                        {{-- new attribute start here dynamically--}}


                        <div id="dynamic-field-1" class="form-group dynamic-field hiding">
                            <div class="row">
                                <div class="col-2 form-group">
                                    <label for="">Image</label>
                                    <input type="file" name="update_image[]" class="form-control-file" value="">
                                    @error("update_image[]")
                                    <div class="alert alert-danger font-size-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-2 form-group">
                                    <label for="update_color_id">Color</label>
                                    <select name="update_color_id[]" id="color_id" class="form-control">
                                        <option value>Select</option>
                                        @foreach ($colors as $color)
                                        <option value="{{$color->id}}">{{$color->color_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2 form-group">
                                    <label for="update_size_id">Size</label>
                                    <select name="update_size_id[]" id="size_id" class="form-control">
                                        <option value>Select</option>
                                        @foreach ($sizes as $size)
                                        <option value="{{$size->id}}">{{$size->size_name}}</option>
                                        @endforeach
                                    </select>
                                    @error("update_size_id[]")
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-2 form-group">
                                    <label for="">Quantity</label>
                                    <input type="text" name="update_quantity[]" class="form-control" value="">
                                    @error("update_quantity[]")
                                    <div class="alert alert-danger font-size-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-2 form-group">
                                    <label for="">Price</label>
                                    <input type="text" name="update_regular_price[]" class="form-control" value="">
                                    @error("regular_price[]")
                                    <div class="alert alert-danger font-size-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-2 form-group">
                                    <label for="">Sale</label>
                                    <input type="text" name="update_sale_price[]" class="form-control update_sale_price"
                                        value="">
                                    @error("update_sale_price[]")
                                    <div class="alert alert-danger font-size-sm">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>
                        </div>

                        {{-- new attribute End here dynamically--}}

                        <div class="clearfix mt-4">
                            <button type="button" id="add-button"
                                class="btn btn-secondary float-left text-uppercase shadow-sm"><i
                                    class="fas fa-plus fa-fw"></i> Add </button>
                            <button type="button" id="remove-button"
                                class="btn btn-secondary float-left text-uppercase ml-1" disabled="disabled"><i
                                    class="fas fa-minus fa-fw"></i> Remove </button>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                </form>
            </div>
            <!-- /.card -->

        </div>
    </section>
</div>
@endsection
@section("toastr_js")
<script>
    @if (session('success'))
  Command: toastr["success"]("{{ session('success') }}")

    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    @endif



$(document).ready(function() {
var buttonAdd = $("#add-button");
var buttonRemove = $("#remove-button");
var className = ".dynamic-field";
var count = 0;
var field = '';
var maxFields = 5;
var first = 1;
$('.hiding').hide();

function totalFields() {
return $(className).length;
}

function addNewField() {
$('.hiding').show();
count = totalFields() + 1;
field = $("#dynamic-field-1").clone();
field.attr("id", "dynamic-field-" + count);
field.children("label").text("Field " + count);
field.find("input").val("");
$(className + ":last").after($(field));
if(first==1){
    $("#dynamic-field-2").remove();
    first = first+1;
}
}

function removeLastField() {
if (totalFields() > 1) {
$(className + ":last").remove();
}
}

function enableButtonRemove() {
if (totalFields() === 2) {
buttonRemove.removeAttr("disabled");
buttonRemove.addClass("shadow-sm");
}
}

function disableButtonRemove() {
if (totalFields() === 1) {
buttonRemove.attr("disabled", "disabled");
buttonRemove.removeClass("shadow-sm");
}
}

function disableButtonAdd() {
if (totalFields() === maxFields) {
buttonAdd.attr("disabled", "disabled");
buttonAdd.removeClass("shadow-sm");
}
}

function enableButtonAdd() {
if (totalFields() === (maxFields - 1)) {
buttonAdd.removeAttr("disabled");
buttonAdd.addClass("shadow-sm");
}
}

buttonAdd.click(function() {
    addNewField();
    enableButtonRemove();
    disableButtonAdd();
});

buttonRemove.click(function() {
    removeLastField();
    disableButtonRemove();
    enableButtonAdd();
    });
});

    $('#category_id').change(function(){
        var category_id = $(this).val();
        if (category_id) {
        $.ajax({
            type:"Get",
            url:"{{ ('/api/get-subcat-list') }}/"+ category_id,
            success:function(res){
                if (res) {
                $("#subcategory_id").empty();
                $("#subcategory_id").append('<option>Select</option>');
                $.each(res,function(key,value){
                $("#subcategory_id").append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');

                });


                }else{
                $("#subcategory_id").empty();
                }

            }
        });

    }else{

    }
    });


</script>
@endsection
