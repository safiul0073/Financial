@extends('layouts.app')
@section('content')
<div class="container-fluid">
        @if(session('status'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <div class="alert-icon contrast-alert">
                    <i class="fa fa-check"></i>
                </div>
                <div class="alert-message">
                    <span><strong>Success!</strong> {{session('status')}} </span>
                </div>
            </div>
        @endif
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Settings</h1>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div >
        <a href="{{ route('cache.clear') }}" class="btn btn-primary">
            Cache Clear
        </a>
    </div>
    <div>
        <a href="{{ route('route.clear') }}" class="btn btn-primary">
            Route Clear
        </a>
    </div>
    <div>
        <a href="{{ route('view.clear') }}" class="btn btn-primary">
            View Clear
        </a>
    </div>

</div>

</div>
@endsection



