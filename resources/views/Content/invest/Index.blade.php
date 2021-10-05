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
        <h1 class="h3 mb-0 text-gray-800 text-uppercase">Invest For Your Partner</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#incomeAdd"><i
                class="fas fa-download fa-sm text-white-50" ></i>Add New Invest</a>
    </div>

    {{--  model for categories --}}


    <div class="modal fade modelTitle" id="incomeAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Invest Amount For Your Partner</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form action="{{route('invest.store')}}" method='POST'>
                        @csrf
                    <div class="form-group">
                        <label for="modalTitle">Investment Amount:</label>
                        <input required type="number" id="modalTitle" class="form-control " name="amount" placeholder='Enter Amount...'>

                    </div>
                    <div class="form-group">
                        <label >Select Partner:</label>

                        <select required class="form-control" name="user_id" id="">
                            <option selected="selected">Select Partner</option>
                            @foreach ($partners as $partner)
                                <option value="{{$partner->id}}">{{$partner->name}}</option>
                            @endforeach

                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" >Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>




    {{-- table sectio here.... --}}

    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pertner Name</th>
                            <th>Invest Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($invests as $key=>$invest)
                        <tr>

                            <td>{{ $key + 1}}</td>
                            <td >{{$invest->user->name}}</td>
                            <td >{{$invest->amount}}</td>
                            <td>
                                <a type="button" data-toggle="modal" data-target="#incomeAdd{{$invest->id}}"
                                    style="color: #1D8348;"
                                    >
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a type="button" style="color:#922B21;" onclick="deleteTitle({{ $invest->id }})">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <form id="delete-form-{{ $invest->id }}" action="{{route('invest.destroy',$invest->id)}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>

                        </tr>

                        <div class="modal fade modelTitle" id="incomeAdd{{$invest->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Expens Title</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{route('invest.update', $invest->id)}}" method='POST'>
                                            @csrf
                                            @method('PUT')
                                        <div class="form-group">
                                            <label for="modalTitle">Title:</label>
                                            <input type="text" id="modalTitle" class="form-control" value="{{!empty($invest) ? $invest->amount : ''}}" name="amount" placeholder='Enter amount...'>
                                        </div>

                                        <div class="form-group">
                                            <label >Income Category:</label>

                                            <select class="form-control" name="user_id" id="">
                                                <option selected="selected">Select Income Category</option>
                                                @foreach ($partners as $partner)
                                                    @if (!empty($invest->user) && $invest->user_id == $partner->id)
                                                        <option selected="selected" value="{{$partner->id}}">{{$partner->name}}</option>
                                                    @else
                                                    <option value="{{$partner->id}}">{{$partner->name}}</option>
                                                    @endif
                                                @endforeach


                                            </select>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" >Update</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach


                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {!! $invests->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
   function deleteTitle(id){

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


