@extends('backend.master');
@section('title')
Edit-SubCategory
@endsection
@section('scategoryactive')
active
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('categories') }}">Categories</a></li>
                        <li class="breadcrumb-item active">Add a Category</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="col-md-6 mx-auto">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">New Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form method="POST" action="{{ route('updatesubcategories') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">

                            <input type="hidden" class="form-control" id="id" value="{{ $scat->id }}"
                                placeholder="Category name" name="id">

                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" id="name" value="{{ $scat->subcategory_name }}"
                                placeholder="Category name" name="subcategory_name">
                            <label for="name">Slug</label>
                            <input type="text" class="form-control" id="name" value="{{ $scat->slug }}"
                                placeholder="Category name" name="slug">


                        </div>
                        {{-- <div class="form-group">
                    <label for="slug"> Slug </label>
                    <input type="text" class="form-control" id="slug" placeholder="Slug"name="slug">
                  </div> --}}
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
  if (session('error')) {
      Command: toastr["error"]("{{ session('error') }}")
        toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
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

  }
    @endif
</script>
@endsection
