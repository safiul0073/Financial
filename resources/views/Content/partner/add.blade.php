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
        <a href="{{route('partner.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50" ></i>Partner</a>
    </div>

    <div class="row">
        <div class="col-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{!empty($user) ? route('partner.update', $user->id) : route('partner.store')}}"  method='POST'>
                        @if (!empty($user))
                            @method("PUT")
                        @endif

                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input autocomplete required type="text" id="name"
                                    value="{{!empty($user) ? $user->name : ''}}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter Pertner Name..."
                                    name="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Partner Email:</label>
                            <input autocomplete type="email" id="email"
                                    value="{{!empty($user) ? $user->email : ''}}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter Pertner email..."
                                    name="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Partner Phone:</label>
                            <input min="0" type="number" id="phone"
                                    value="{{!empty($user) ? $user->phone : ''}}"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="Enter Pertner phone..."
                                    name="phone">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="initial_amount">Initial Investment:</label>
                            <input type="text" id="initial_amount"
                                    value="{{!empty($user) ? $user->initial_amount : ''}}"
                                    class="form-control @error('initial_amount') is-invalid @enderror"
                                    placeholder="Enter Pertner Amount..."
                                    name="initial_amount">
                            @error('initial_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea type="text"  class="form-control @error('address') is-invalid @enderror" rows="4"  name="address">{{!empty($user) ? $user->address : ''}}</textarea>
                            @error('address')
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


