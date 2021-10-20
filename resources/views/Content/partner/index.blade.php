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
        <h1 class="h3 mb-0 text-gray-800">Partners Information</h1>
        <div class="d-flex justify-content-between align-items-center">
            <input type="text" id="myInput" class="form-control bg-light border-1 small"  placeholder="Search Name.." aria-label="Search" aria-describedby="basic-addon2">
        </div>
        <a href="{{route('partner.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add Partner</a>
    </div>

    {{-- table sectio here.... --}}

    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Initila Amount</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="myTable">
                        @foreach($partners as $key=>$partner)
                            <tr>

                                <td>{{ $key + 1}}</td>
                                <td >{{ $partner->name }}</td>
                                <td >{{ $partner->email }}</td>
                                <td >{{ $partner->phone }}</td>
                                <td >{{ $partner->invest? $partner->invest->date : ''}}</td>
                                <td >{{ $partner->invest? $partner->invest->amount : ''}}</td>
                                <td >{{$partner->address}}</td>
                                <td >
                                    <div class="d-flex">
                                        <a
                                            href="{{ route('partner.show', $partner->id) }}"
                                            class="text-gray-600"
                                            >
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a  class="mx-1"
                                            href="{{ route('partner.edit', $partner->id) }}"
                                            style="color: #1D8348;"
                                            >
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a type="button" style="color:#922B21;" onclick="deleteIncame({{ $partner->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <form id="delete-form-{{ $partner->id }}" action="{{route('partner.destroy',$partner->id)}}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>

                            </tr>


                            @endforeach


                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {!! $partners->links() !!}
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

$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

@endpush


