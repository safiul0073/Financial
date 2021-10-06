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
        <h1 class="h3 mb-0 text-gray-800">Expense</h1>
        <a href="{{route('expense.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50" ></i>Expense</a>
    </div>

    <div class="row">
        <div class="col-12 col-xl-6 col-lg-6 col-md-8 col-sm-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{!empty($expense) ? route('expense.update', $expense->id) : route('expense.store')}}"  method='POST'>
                        @if (!empty($expense))
                            @method("PUT")
                        @endif

                        @csrf
                        <div class="form-group">
                            <label for="ItemCategory">Expense Category:</label>
                            <select class="form-control @error('expense_categorie_id') is-invalid @enderror"  name="expense_categorie_id" data-dependent="income_title" id="ItemCategory">
                                <option selected="selected">Select Expense Category</option>
                                @foreach ($categories as $category)
                                    @if (!empty($expense->expense_category) && $expense->expense_categorie_id == $category->id)
                                        <option selected="selected" value="{{$category->id}}">{{$category->title}}</option>
                                    @else
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('incame_categorie_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="ItemCategory">Expense Title:</label>
                            <select class="form-control" name="expense_title_id" id="income_title">
                                <option selected="selected">Select Expense Title</option>
                                @foreach ($titles as $title)
                                    @if (!empty($expense->expense_title) && $expense->expense_title_id == $title->id)
                                        <option selected="selected" value="{{$title->id}}">{{$title->title}}</option>
                                    @else
                                        <option value="{{$title->id}}">{{$title->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="amount">Total Amount</label>
                            <input type="number" min="0" id="amount" value="{{!empty($expense) ? $expense->amount : 0}}" class="form-control @error('amount') is-invalid @enderror" placeholder="Enter Total amount" name="amount">
                            @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date">Incame Date:</label>
                            <input type="date"
                                    id="date"value="{{!empty($expense) ? $expense->expense_date : ''}}"
                                    class="form-control @error('expense_date') is-invalid @enderror"
                                    name="expense_date">
                                @error('expense_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="amount">Bayer Name:</label>
                            <input type="text" value="{{!empty($expense) ? $expense->seller_name : ''}}"
                                   class="form-control @error('seller_name') is-invalid @enderror"
                                   placeholder="Enter Seller name..."
                                   name="seller_name">
                                    @error('seller_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                        <div class="form-group">
                            <label for="amount">Bayer Phone:</label>
                            <input type="text"
                                   value="{{!empty($expense) ? $expense->seller_phone : ''}}"
                                   class="form-control @error('bayer_phone') is-invalid @enderror"
                                   placeholder="Enter Seller phone..."
                                   name="seller_phone">
                                    @error('bayer_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                        <div class="form-group">
                            <label for="amount">Dascription:</label>
                            <textarea type="text" value='' class="form-control @error('description') is-invalid @enderror" rows="3"  name="description">{{!empty($expense) ? $expense->description : ''}}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('js')

<script type="text/javascript">
    // dynamic dependent value change by income title...
    $(document).ready(function(){

    $('#ItemCategory').change(function(){
    if($(this).val() != '')
    {
        var select = $(this).attr("id");
        var _token = $('input[name="_token"]').val();
        var dependent = $(this).data('dependent');
        var value = $(this).val();
        $.ajax({
        url:"{{ route('dynamicdependent.expense.fetch') }}",
        method:"POST",
        data:{select:select, value:value, _token:_token},
        success:function(result)
        {
            $('#'+dependent).html(result);
        }

        })
    }
    });

    $('#ItemCategory').change(function(){
    $('#income_title').val('');

    });

    });

</script>

@endpush


