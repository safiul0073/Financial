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
        <a href="{{route('incame.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50" ></i>Income</a>
    </div>

    <div class="row">
        <div class="col-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{!empty($incame) ? route('incame.update', $incame->id) : route('incame.store')}}"  method='POST'>
                        @if (!empty($incame))
                            @method("PUT")
                        @endif

                        @csrf
                        <div class="form-group">
                            <label for="ItemCategory">Incame Category:</label>
                            <select class="form-control @error('incame_categorie_id') is-invalid @enderror"  name="incame_categorie_id" data-dependent="income_title" id="ItemCategory">
                                <option selected="selected">Select Income Category</option>
                                @foreach ($categories as $category)
                                    @if (!empty($incame->income_category) && $incame->incame_categorie_id == $category->id)
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
                            <label for="ItemCategory">Incame Title:</label>
                            <select class="form-control" name="incame_title_id" id="income_title">
                                <option selected="selected">Select Income Title</option>
                                @foreach ($titles as $title)
                                    @if (!empty($incame->income_title) && $incame->incame_title_id == $title->id)
                                        <option selected="selected" value="{{$title->id}}">{{$title->title}}</option>
                                    @else
                                        <option value="{{$title->id}}">{{$title->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="amount">Total Amount</label>
                            <input type="number" min="0" id="amount" value="{{!empty($incame) ? $incame->amount : 0}}" class="form-control @error('amount') is-invalid @enderror" placeholder="Enter Total amount" name="amount">
                            @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date">Incame Date:</label>
                            <input type="date" id="date"value="{{!empty($incame) ? $incame->incame_date : ''}}" class="form-control @error('incame_date') is-invalid @enderror"  name="incame_date">
                            @error('incame_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="amount">Bayer Name:</label>
                            <input type="text" value="{{!empty($incame) ? $incame->bayer_name : ''}}" class="form-control @error('bayer_name') is-invalid @enderror" placeholder="Enter Bayer name..."  name="bayer_name">
                            @error('bayer_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="amount">Bayer Phone:</label>
                            <input type="text" value="{{!empty($incame) ? $incame->bayer_phone : ''}}" class="form-control @error('bayer_phone') is-invalid @enderror" placeholder="Enter Bayer phone..."  name="bayer_phone">
                            @error('bayer_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="amount">Dascription:</label>
                            <textarea type="text" value='' class="form-control @error('bayer_phone') is-invalid @enderror" rows="3"  name="description">{{!empty($incame) ? $incame->description : ''}}</textarea>
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
        url:"{{ route('dynamicdependent.fetch') }}",
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


