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
        <h1 class="h3 mb-0 text-gray-800 text-uppercase">Report For Income</h1>

            <button onclick="myApp.printTable()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Print Report</button>


    </div>


    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-10 mx-auto">

                    <form action="{{ route('income.report.get') }}" method="post" >
                        @csrf
                        <div class="d-sm-flex align-items-center justify-content-center">
                            <div class="form-group mr-2 align-items-center d-flex">
                                <label class="mx-2" for="selectDate">from: </label>
                                <input type="date" name="start_date" value="{{ !empty($start_date) ? $start_date : "" }}" class="form-control">
                            </div>
                            <div class="form-group mr-5 align-items-center d-flex">
                                <label class="mx-2" for="selectDate">to: </label>
                                <input type="date" value="{{ !empty($end_date) ? $end_date : "" }}" name="end_date" class="form-control">
                            </div>
                            <div clase="align-items-center justify-items-center d-flex">
                                <button class="btn btn-primary mb-3">Search</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('income.report.get') }}" method="post" >
                                @csrf
                                <div class="d-sm-flex align-items-center justify-content-center">

                                    <div class="form-group mr-5 align-items-center d-flex col-7">
                                        <label class="mx-2" class="col-4" for="">Use Category to Search: </label>
                                        <select class="form-control col-6" name="category" id="">
                                            {{-- <option selected="selected">Select Category</option> --}}
<<<<<<< HEAD
                                            @foreach ($categorys as $incameCategory)
=======
                                            @foreach ($incameCategorys as $incameCategory)
>>>>>>> 85ff2ffd93e04f59cbdcdd94069726d68110ab12
                                                @if (!empty($category) && $category == $incameCategory->id)
                                                    <option selected="selected" value="{{ $incameCategory->id }}">{{ $incameCategory->title }}</option>
                                                @else

                                                @endif
                                                <option value="{{ $incameCategory->id }}">{{ $incameCategory->title }}</option>
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
            @if (!empty($incomes))
            <div>
                <h1 class="text-uppercase">Total Amount: {{ floatval($incomes->sum('amount'))}}</h1>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dvContents" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Amount</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (!empty($incomes))
                            @foreach($incomes as $key=>$income)
                            <tr>

                                <td>{{ $key + 1}}</td>
                                <td >{{$income->category ? $income->category->title : '' }}</td>
                                <td >{{$income->income_title ? $income->income_title->title : ''}}</td>
                                <td >{{$income->amount}}</td>

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
    <script>
    var myApp = new function () {
        this.printTable = function () {
            var tab = document.getElementById('dvContents');
            var win = window.open('', '', 'height=720,width=1024');
            win.document.write(tab.outerHTML);
            win.document.close();
            win.print();
        }}
    </script>
@endpush


