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
        <h1 class="h3 mb-0 text-gray-800">Partner Information</h1>
        <a href="{{route('partner.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Partners</a>
    </div>

    <div class="row">
        <div class="col-12 col-xl-6 col-lg-6 col-md-8 col-sm-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered ">
                        <thead class='thead-dark '>
                          <tr class="text-center">
                            <th scope="col">Name</th>
                            <th scope="col">Information</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $key => $item)
                            <tr>
                                <th scope="row">{!! $key.":" !!}</th>
                                <td scope="row">{!! $item !!}</td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection




