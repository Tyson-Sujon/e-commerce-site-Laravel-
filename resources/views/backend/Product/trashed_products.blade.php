@extends('backend.master');
@section('title')
Trashed-Product
@endsection
@section('productactive')
active
@endsection

@section('productopen')
menu-is-opening menu-open active
@endsection

@section('producttrashcatactive')
bg-success
@endsection

@section("content")
<div class="content-wrapper" style="min-height: 1299.69px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 block red">
                    <h1>Trash Table</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ 'categories' }}">Categories</a></li>
                        <li class="breadcrumb-item active">Trashed Data</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Trashed Products</strong></h3>
                            <a class="float-right" href="{{ url('categories') }}">
                                <i class="fa fa-list"> All Categories</i>
                            </a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th style="width: 10px">SL</th>
                                        <th>Name</th>
                                        <th>Summery</th>
                                        <th>Thumbnail</th>
                                        <th>Deleted At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $key => $product)
                                    <tr>

                                        <td>{{ $products->firstItem() + $key }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->summery }}</td>
                                        <td><img src="{{ asset('asset/thumb/'.$product->thumbnail)}}" width="50" alt="">
                                        </td>
                                        <td>{{ $product->deleted_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-Success"
                                                href="{{ url('restore-categories')}}/{{ $product->id }}">Restore</a>
                                            <a class="btn btn-danger"
                                                href="{{ url('Permanent-delete-categories/')}}/{{ $product->id }}">Delete</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No Data Avaibable</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        {{ $products->links() }}
                        {{-- <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div> --}}
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <!-- /.col -->
            </div>


        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
</script>
@endsection
