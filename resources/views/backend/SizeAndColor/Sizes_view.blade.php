@extends('backend.master');
@section('title')
Size Page
@endsection
@section('content')
@section('sizeactive')
active
@endsection

@section('sizeopen')
menu-is-opening menu-open active
@endsection

@section('sizeviewactive')
bg-success
@endsection

<div class="content-wrapper" style="min-height: 1299.69px;">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New Size</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('categories') }}">Categories</a></li>
                        <li class="breadcrumb-item active"> Create Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content md-6">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Category Table</strong></h3>
                            <a class="float-right" href="{{ url('add-categories') }}">
                                <i class="fa fa-plus"> Category</i>
                            </a>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th style="width: 10px">SL</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Created At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($datas as $key => $data)
                                    <tr>

                                        <td>{{ $datas->firstItem() + $key }}</td>
                                        <td>{{ $data->size_name }}</td>
                                        <td>{{ $data->slug }}</td>
                                        <td>{{ $data->created_at->format('d-M-Y h:i:s a') }}
                                            ({{ $data->created_at->diffForHumans() }})</td>
                                        <td class="text-center">
                                            <a class="btn btn-danger sizeDelete" data-id="{{$data->id}}">Delete</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No Data Avilable</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $datas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="content mt-5">
        <div class="col-md mx-auto">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">New Category</h3>
                </div>

                <form method="POST" action="{{ route('PostSize') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Size Name</label>
                            <input type="text" class="form-control @error('size_name') is-invalid @enderror"
                                id="size_name" placeholder="Size name" name="size_name" value="{{old('size_name')}}">
                        </div>
                        @error('size_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="slug"> Slug </label>
                            <input type="readonly" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                placeholder="Slug" name="slug">
                        </div>
                        @error('slug')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>

        </div>
    </section>

</div>

@endsection

@section('toastr_js')
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



    $('#size_name').keyup(function() {
        $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g, "-"));
    });

    $('.sizeDelete').click(function(){
        let id = $(this).attr("data-id");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {

            window.location.href = "/delete-size/"+id;
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )

        }

        });
    });
</script>
@endsection
