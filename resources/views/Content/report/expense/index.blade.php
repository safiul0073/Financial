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
        <h1 class="h3 mb-0 text-gray-800 text-uppercase">Report For Expense</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Downloads Report</a>
    </div>


    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-10 mx-auto">

                    <form action="{{ route('expense.report.get') }}" method="post" >
                        @csrf
                        <div class="d-sm-flex align-items-center justify-content-center">
                            <div class="form-group mr-2 align-items-center d-flex">
                                <label class="mx-2" for="selectDate">from: </label>
                                <input type="date" name="start_date" class="form-control">
                            </div>
                            <div class="form-group mr-5 align-items-center d-flex">
                                <label class="mx-2" for="selectDate">to: </label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                            <div clase="align-items-center justify-items-center d-flex">
                                <button type="submit" class="btn btn-primary mb-3">Search</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('expense.report.get') }}" method="post" >
                                @csrf
                                <div class="d-sm-flex align-items-center justify-content-center">

                                    <div class="form-group mr-5 align-items-center d-flex col-7">
                                        <label class="mx-2" class="col-4" for="">Use Category to Search: </label>
                                        <select class="form-control col-6" name="category" id="">
                                            <option selected="selected">Select Category</option>
                                            @foreach ($expenseCategorys as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div clase="align-items-center justify-items-center d-flex">
                                        <button type="submit" class="btn btn-primary mb-3">Search</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if (!empty($expenses))
            <div>
                <h1 class="text-uppercase">Total Amount: {{ floatval($expenses->sum('amount'))}}</h1>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Seller Name</th>
                            <th>Seller Phone</th>

                        </tr>
                    </thead>

                    <tbody>
                        @if (!empty($expenses))
                            @foreach($expenses as $key=>$expense)
                            <tr>

                                <td>{{ $key + 1}}</td>
                                <td >{{$expense->expense_category ? $expense->expense_category->title : '' }}</td>
                                <td >{{$expense->expense_title ? $expense->expense_title->title : ''}}</td>
                                <td >{{$expense->amount}}</td>
                                <td >{{$expense->seller_name}}</td>
                                <td >{{$expense->seller_phone}}</td>

                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
@push('js')

@endpush


