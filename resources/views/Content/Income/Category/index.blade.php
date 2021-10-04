@extends('layouts.app')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Income Category</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#categoryAdd"><i
                class="fas fa-download fa-sm text-white-50" ></i> Add Category</a>
    </div>

    {{--  model for categories --}}


    <div class="modal fade modelCategory" id="categoryAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form action="{{route('incomecategory.store')}}" method='POST'>
                        @csrf
                    <div class="modal-content">
                        <input type="text" class="modal-content" value="{{!empty($category) ? $category->title : ''}}" name="title" placeholder='Enter Category Title:'>
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
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($categories as $key=>$category)
                        <tr>

                            <td>{{ $key + 1}}</td>
                            <td>{{$category->title}}</td>
                            <td>
                                <a href="" data-toggle="modal" onclick="openModel({{$category->id}})" data-target="#categoryAdd{{ !empty($category->id) }}">edit</a>
                            </td>

                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script type="text/javascript">
        const model = document.getElementsByClassName('modelCategory');

        openModel (id) {
            console.log(model, id)
        }

    </script>
@endpush
