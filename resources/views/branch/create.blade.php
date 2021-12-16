@extends('layouts.app')

@section('title')
    Create New Branch
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('assets/css')}}/bootstrap-4.min.css">
 <!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/css') }}/toastr.min.css">
@endpush

@section('breadcrumb')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Create New Branch Page</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('branch.index') }}">List Branch</a></li>
            <li class="breadcrumb-item active">Create Branch Page</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

@endsection

@section('content')
    <!-- Horizontal Form -->
    <div class="card">
        <div class="card-header clearfix">
          <h3 class="card-title">Create Branch Form</h3>
          <a href="{{route('branch.index')}}" class="btn btn-xs btn-primary float-right">Branch List</a>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('branch.store') }}" method="POST" class="form-horizontal">
            @csrf
          <div class="card-body">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">Name</label>
                        <div class="col-md-8">
                          <input type="Name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" id="name" placeholder="Name" />
                          @error('name')
                              <div class="invalid-feedback">
                                  <strong>{{ $message }}</strong>
                              </div>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="date" class="col-md-4 col-form-label">Branch Open Date</label>
                        <div class="col-md-8">
                          <input type="date" name="start_date" value="{{old('start_date')}}" class="form-control @error('start_date')
                              is-invalid
                          @enderror" id="date" placeholder="Branch opening date" />
                          @error('start_date')
                              <div class="invalid-feedback">
                                  <strong>{{ $message }}</strong>
                              </div>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="date" class="col-md-4 col-form-label">Branch Opening Capital</label>
                        <div class="col-md-8">
                          <input type="number" value="{{old('start_capital')}}" name="start_capital" class="form-control @error('start_capital')
                              is-invalid
                          @enderror" id="date" placeholder="Branch Opening Capital" />

                          @error('start_capital')
                              <div class="invalid-feedback">
                                  <strong>{{$message}}</strong>
                              </div>
                          @enderror
                        </div>
                      </div>
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-between">
                <h5>Additional Information</h5>
                <div class="form-check">
                    <input type="checkbox" value="1" {{ old('setting') == 1 ? "checked" : "" }} class="form-check-input" id="setting">
                    <label class="form-check-label" name="setting" for="setting">Overrite Account Setting</label>
                  </div>
            </div>

            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="form-group row">
                        <label for="country" class="col-md-4 col-form-label">Country</label>
                        <div class="col-md-8">
                            <select class="form-control" id="country" name="country">
                                @php
                                    $countries = ["bangladesh" => "Bangladesh", "india" => "India", "pakistan" => "Pakistan", "srilanka" => "Srilanka"];
                                @endphp
                                @foreach ($countries as $key => $country)
                                <option value="{{$key}}" {{ old('country') == $key ? "selected" : "" }}>{{$country}}</option>
                                @endforeach
                              </select>
                        </div>
                      </div>
        
                      <div class="form-group row">
                        <label for="currency" class="col-md-4 col-form-label">Currency</label>
                        <div class="col-md-8">
                            <select class="form-control" id="currency" name="currency">
                                @php
                                    $currencies = ["tk" => "taka", "usd" => "Us Dollar", "ruppe" => "Ruppe", "euro" => "Euro", "dirhum" => "Dirhum"];
                                @endphp
                                @foreach ($currencies as $curren => $currency)
                                <option value="{{ $curren }}" {{ old('currency') == $curren ? "selected" : ""}}>{{ $currency }}</option>
                                @endforeach
                               
                              </select>
                        </div>
                      </div>
        
                      <div class="form-group row">
                        <label for="date-format" class="col-md-4 col-form-label">Date Format</label>
                        <div class="col-md-8">
                            <select class="form-control" id="date-format" name="date_format">
                                @php
                                    $date_formats = ["yyyy/mm/dd","dd/mm/yyyy","mm/dd/yyyy"];
                                @endphp
                                @foreach ($date_formats as $date_format)
                                    
                                <option value="{{$date_format}}" {{old('date_format') == $date_format ? "selected" : ""}}>{{ $date_format }}</option>
                                @endforeach
                            
                              </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="currency-in-words" class="col-md-4 col-form-label">Currency In words</label>
                        <div class="col-md-8">
                          <input type="text" value="{{ old('currency_in_words') }}" name="currency_in_words" class="form-control" id="currency-in-words" placeholder="currency in words">
                        </div>
                      </div>
                </div>
            </div>

              <hr>

            <div class="">
                <h5>Address Information</h5>
            </div>

            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label">Branch Address</label>
                        <div class="col-md-8">
                          <input type="text" name="address" value="{{old('address')}}" class="form-control" id="address" placeholder="branch address">
                        </div>
                      </div>
        
                      <div class="form-group row">
                        <label for="city" class="col-md-4 col-form-label">Branch City</label>
                        <div class="col-md-8">
                          <input type="text" name="city" value="{{ old('city') }}" class="form-control" id="city" placeholder="branch city">
                        </div>
                      </div>
        
                      <div class="form-group row">
                        <label for="province" class="col-md-4 col-form-label">Branch Province</label>
                        <div class="col-md-8">
                          <input type="text" name="province" value="{{ old('province')}}" class="form-control" id="province" placeholder="branch province">
                        </div>
                      </div>
        
                      <div class="form-group row">
                        <label for="zipcode" class="col-md-4 col-form-label">Branch Zipcode</label>
                        <div class="col-md-8">
                          <input type="text" name="zipcode" value="{{ old('zipcode') }}" class="form-control" id="zipcode" placeholder="branch zipcode">
                        </div>
                      </div>
        
                      <div class="form-group row">
                        <label for="landline" class="col-md-4 col-form-label">Branch Landline</label>
                        <div class="col-md-8">
                          <input type="text" name="landline" value="{{ old('landline') }}" class="form-control" id="landline" placeholder="branch landline">
                        </div>
                      </div>
        
        
                      <div class="form-group row">
                        <label for="mobile" class="col-md-4 col-form-label">Branch Mobile</label>
                        <div class="col-md-8">
                          <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control" id="mobile" placeholder="mobile">
                        </div>
                      </div>
                </div>
            </div>

            <hr>
            <div class="">
                <h5>Loan Restriction Information</h5>
            </div>


            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="form-group row">
                        <label for="minimum_loan_amount" class="col-md-4 col-form-label">Minimum Loan Amount</label>
                        <div class="col-md-8">
                          <input type="number" name="minimum_loan_amount" class="form-control" id="minimum_loan_amount" value="{{old('minimum_loan_amount')}}" placeholder="Minimum Loan Amount">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="maximum_loan_amount" class="col-md-4 col-form-label">Maximum Loan Amount</label>
                        <div class="col-md-8">
                          <input type="number" name="maximum_loan_amount" class="form-control" id="maximum_loan_amount" value="{{old('maximum_loan_amount')}}" placeholder="Maximum Loan Amount">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="minimum_interest_rate" class="col-md-4 col-form-label">Minimum Intarest Rate</label>
                        <div class="col-md-8">
                          <input type="number" name="minimum_interest_rate" class="form-control" id="minimum_interest_rate" value="{{ old('minimum_interest_rate')}}" placeholder="Minimum Interest Rate">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="maximum_interest_rate" class="col-md-4 col-form-label">Maximum Interest Rate</label>
                        <div class="col-md-8">
                          <input type="number" name="maximum_interest_rate" class="form-control" id="maximum_interest_rate" value="{{old('maximum_interest_rate')}}" placeholder="Maximum Interest Rate">
                        </div>
                      </div>
                </div>
            </div>


          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save branch</button>
            <button type="reset" class="btn btn-default float-right">Cancel</button>
          </div>
          <!-- /.card-footer -->
        </form>
      </div>
      <!-- /.card -->
@endsection


@push('js')
<script src="{{ asset('assets/js') }}/sweetalert2.min.js"></script>
<script src="{{ asset('assets/js') }}/toastr.min.js"></script>
@endpush

@push('scripts')
@if (session('errors'))
<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });

        // $('.swalDefaultSuccess').click(function() {
            Toast.fire({
                icon: 'error',
                title: @json(session('errors'))
            })
        // });
    })
</script>
@endif
@endpush