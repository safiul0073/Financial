@extends('layouts.app')
@section('content')
<div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <div class="alert-icon contrast-alert">
                    <i class="fa fa-check"></i>
                </div>
                <div class="alert-message">
                    <span><strong>Success!</strong> {{session('success')}} </span>
                </div>
            </div>
        @endif
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Income</h1>
        <a href="{{route('incame.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add Income</a>
    </div>

    {{-- table sectio here.... --}}

    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Income Date</th>
                            <th>Bayer</th>
                            <th>Bayer Phone</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($incams as $key=>$incame)
                            <tr>

                                <td>{{ $key + 1}}</td>
                                <td >{{$incame->income_category ? $incame->income_category->title : '' }}</td>
                                <td >{{$incame->income_title ? $incame->income_title->title : ''}}</td>
                                <td >{{$incame->amount}}</td>
                                <td >{{$incame->incame_date}}</td>
                                <td >{{$incame->bayer_name}}</td>
                                <td >{{$incame->bayer_phone}}</td>
                                <td >{{$incame->description}}</td>
                                <td>
                                    <a type="button"
                                        href="{{ route('incame.edit', $incame->id) }}"
                                        style="color: #1D8348;"
                                        >
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a type="button" style="color:#922B21;" onclick="deleteIncame({{ $incame->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <form id="delete-form-{{ $incame->id }}" action="{{route('incame.destroy',$incame->id)}}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>

                            </tr>


                            @endforeach


                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $incams->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
   function deleteIncame(id){

        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You want to delete this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
        event.preventDefault();
        document.getElementById('delete-form-'+id).submit();
        } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
        ) {
        swalWithBootstrapButtons.fire(
        'Cancelled',
        'Your imaginary file is safe :)',
        'error'
        )
        }
        })

}
</script>

@endpush


