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
                            <label for="date">Date:</label>
                            <input type="date"
                                    id="date" value="{{!empty($user->invest) ? $user->invest->date : ''}}"
                                    class="form-control @error('date') is-invalid @enderror"
                                    name="date">
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="initial_amount">Initial Investment:</label>
                            <input type="number" id="initial_amount"
                                    step="0.01"
                                    value="{{!empty($user->invest) ? $user->invest->amount : ''}}"
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
                            <label for="amount">Comment:</label>
                            <textarea type="text" class="form-control @error('comment') is-invalid @enderror" rows="3"  name="comment">{{!empty($user->invest) ? $user->invest->comment : ''}}</textarea>
                            @error('comment')
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
                            <div class="col-xs-6">
                                <label for="password"><h4>New Password</h4></label>
                                <div class="d-flex align-items-center">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="new password" >
                                <a class="ml-2" id="show_pass"><i class="fas fa-eye"></i></a>
                            </div>
                            </div>
                            @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="password-confirm"><h4>Again Password</h4></label>
                                <div class="d-flex align-items-center">
                                <input  placeholder="Retype password" type="password" id="password-confirm" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <a class="ml-2" id="show_pass_con"><i class="fas fa-eye"></i></a>
                            </div>
                            </div>
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

    $('#show_pass').on('click', function (e) {
        let type = $('#password').attr('type')
        let con_type = $('#password-confirm').attr('type')
        type === 'password' ? $('#password').attr('type', 'text') : $('#password').attr('type', 'password')
    })
    $('#show_pass_con').on('click', function (e) {
        let type = $('#password-confirm').attr('type')

        type === 'password' ? $('#password-confirm').attr('type', 'text') : $('#password-confirm').attr('type', 'password')
    })
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


