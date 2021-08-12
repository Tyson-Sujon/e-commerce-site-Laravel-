@extends('backend.master');
@section('title')
Trashed-SubCategory
@endsection
@section('scategoryactive')
active
@endsection

@section('scatopen')
menu-is-opening menu-open active
@endsection

@section('strashcatactive')
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
                            <h3 class="card-title"><strong>Trash</strong></h3>
                            <a class="float-right" href="{{ route('Subcategories') }}">
                                <i class="fa fa-list"> All Categories</i>
                            </a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('PosstDeleteAllSubcategories') }}" method="POST">
                                @csrf
                                <table class="table table-bordered">

                                    <thead>
                                        <tr>
                                            <th> <input type="checkbox" id="checkall"><span class="ml-2">All</span></th>
                                            <th style="width: 10px">SL</th>
                                            <th>Sub Category</th>
                                            <th>Category</th>
                                            <th>Slug</th>
                                            <th>Created At</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($deletedsubcategory as $key => $data)
                                        <tr>
                                            <td> <input type="checkbox" id="checkbox" class="control-input"
                                                    name="delete[]" value="{{ $data->id }}"></td>
                                            <td>{{ $deletedsubcategory->firstItem() + $key }}</td>
                                            <td>{{ $data->subcategory_name }}</td>
                                            <td>{{ $data->Category->category_name }}</td>
                                            <td>{{ $data->slug }}</td>
                                            <td>{{ $data->created_at->format('d-M-Y h:i:s a') }}
                                                ({{ $data->created_at->diffForHumans() }})</td>
                                            <td class="text-center">
                                                <a class="btn btn-warning"
                                                    href="{{ route('PermanentdeleteSubCategory',$data->slug) }}">Delete</a>
                                                <a class="btn btn-success"
                                                    href="{{ route('PermanentrestoreSubCategory',$data->slug)}}">Restore</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center">No Data Avilable</td>
                                        </tr>
                                        @endforelse

                                    </tbody>
                                </table>

                                <input type="submit" name="button" value="delete" class="btn btn-primary" id="submit">
                                <input type="submit" name="button" value="restore" class="btn btn-primary" id="submit">
                            </form>
                        </div>
                        <!-- /.card-body -->
                        {{ $deletedsubcategory->links() }}
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

      $('#checkall').click(function(){
        $('input:checkbox').not(this).prop('checked',this.checked);
        $("#submit").show();
      });

</script>
@endsection
