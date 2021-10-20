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
        <h1 class="h3 mb-0 text-gray-800 text-uppercase">Report For Partner</h1>

            <button onclick="myApp.printTable()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Print</button>


    </div>


    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-10 mx-auto">
                    <form action="{{ route('report.partner.get') }}" method="post" >
                        @csrf
                        <div class="d-sm-flex align-items-center justify-content-center">
                            <div class="form-group mr-2 align-items-center d-flex">
                                <label class="mx-2" for="selectDate">from: </label>
                                <select name="partnar_search_id" class="form-control select2" placeholder="Select City" required>

                                    <option value="All">All</option>
                                    @foreach ($partners as $partner)
                                        @if (!empty($partnar_search_id) && $partnar_search_id == $partner->id)
                                            <option selected  value="{{$partner->id}}">{{$partner->name}}</option>
                                        @else
                                            <option value="{{$partner->id}}">{{$partner->name}}</option>
                                        @endif
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

            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('report.partner.get') }}" method="post" >
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
                                        <button type="submit" class="btn btn-primary mb-3">Search</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          <div class="table-responsive">
                    <table id="dvContents" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center border border-dark">ID</th>
                                <th class="text-center border border-dark">Name</th>
                                <th class="text-center border border-dark">Email</th>
                                <th class="text-center border border-dark">Phone</th>
                                <th class="text-center border border-dark">Invests</th>
                                <th class="text-center border border-dark">Total Invest Amount</th>

                            </tr>
                        </thead>

                        <tbody>
                        @if (!empty($partnerReports) || !empty($partnerOfDate))
                            @if (count($partnerReports) > 0)
                                @foreach($partnerReports as $key=>$partnerReport)
                                <tr class="border border-secondary">

                                    <td class="text-center border border-dark">{{ $key + 1}}</td>
                                    <td class="text-center border border-dark">{{$partnerReport->name}}</td>
                                    <td class="text-center border border-dark" >{{$partnerReport->email}}</td>
                                    <td class="text-center border border-dark">{{$partnerReport->phone}}</td>
                                    <td class="text-center border border-dark">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($partnerReport->invests as $item)
                                                    <tr>
                                                        <td>{{$item->date}}</td>
                                                        <td>{{$item->amount}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="text-center border border-dark">{{$partnerReport->invests->sum('amount')}}</td>

                                </tr>
                                @endforeach
                                <tr class="border border-secondary">

                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td class="text-center">
                                        Total Amount:
                                    </td>
                                    <td class="text-center">{{ floatval(calculatTotalAmount($partnerReports))}}</td>

                                </tr>
                                <tr class="border border-secondary">

                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td class="text-center">
                                        Total Profit:
                                    </td>
                                    <td class="text-center">{{ floatval($profits)}}</td>

                                </tr>
                            @else
                                @foreach($partnerOfDate as $key=>$partnerReport)
                                <tr class="border border-secondary">

                                    <td class="text-center border border-dark">{{ $key + 1}}</td>
                                    <td class="text-center border border-dark">{{$partnerReport->user->name}}</td>
                                    <td class="text-center border border-dark" >{{$partnerReport->user->email}}</td>
                                    <td class="text-center border border-dark">{{$partnerReport->user->phone}}</td>
                                    <td class="text-center border border-dark">
                                        {{$partnerReport->date}}
                                    </td>
                                    <td class="text-center border border-dark">{{$partnerReport->amount}}</td>

                                </tr>
                                @endforeach
                                <tr class="border border-secondary">

                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td class="text-center">
                                        Total Amount:
                                    </td>
                                    <td class="text-center">{{ !empty($partnerOfDate) ? floatval($partnerOfDate->sum('amount')) : '' }}</td>

                                </tr>
                                <tr class="border border-secondary">

                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td class="text-center">
                                        Total Profit:
                                    </td>
                                    <td class="text-center">{{ floatval($profits)}}</td>

                                </tr>
                            @endif
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
        $(document).ready(function() {
            $('.select2').select2();
        });

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


