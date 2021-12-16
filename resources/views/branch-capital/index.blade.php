@extends('layouts.app')

@section('title')
    Manage branch Capital
@endsection


@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css') }}/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/css') }}/toastr.min.css">
@endpush

@section('breadcrumb')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Branch Capital Page</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('branch.create') }}">Create New Branch Capital</a></li>
              <li class="breadcrumb-item active">Branch Capital List Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
@endsection

@section('content')
<div class="card">
    <div class="card-header clearfix">
        <h3 class="card-title float-left align-middle my-0">Branch Deposit Capital Table</h3>
        <a href="{{ route('branch-capital.create',$id) }}" class="btn btn-xs btn-secondary float-right"><i
                class="fa fa-plus"></i> Create New Branch Capital</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Deposit Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $deposit_total = 0;
                @endphp
                @foreach ($deposit_capitals as $deposit_capital)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $deposit_capital->capital_date }}</td>
                        <td>{{ $deposit_capital->description }}</td>
                        <td>{{ $deposit_capital->capital_amount }}</td>
                        @php
                            $deposit_total += $deposit_capital->capital_amount
                        @endphp
                        <td>
                            {{$deposit_capital->status}}
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('branch-capital.edit',$deposit_capital->id)}}"
                                    class="btn btn-xs btn-primary">Edit</a>
                                <a href="" class="btn btn-xs btn-danger">Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-right">Total</td>
                    <td><strong>{{ $deposit_total }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header clearfix">
        <h3 class="card-title float-left align-middle my-0">Branch Withdrawal Capital Table</h3>
        <a href="{{ route('branch-capital.create',$id) }}" class="btn btn-xs btn-secondary float-right"><i
                class="fa fa-plus"></i> Create New Branch Capital</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Withdrawal Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $withdrawal_total = 0;
                @endphp
                @foreach ($withdrawal_capitals as $withdrawal_capital)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $withdrawal_capital->capital_date }}</td>
                        <td>{{ $withdrawal_capital->description }}</td>
                        <td>{{ $withdrawal_capital->capital_amount }}</td>
                        @php
                            $withdrawal_total += $withdrawal_capital->capital_amount;
                        @endphp
                        <td>
                            {{$withdrawal_capital->status}}
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('branch-capital.edit',$withdrawal_capital->id)}}"
                                    class="btn btn-xs btn-primary">Edit</a>
                                <a href="" class="btn btn-xs btn-danger">Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @if ($withdrawal_total > 0)   
                
                <tr>
                    <td colspan="3" class="text-right">Total</td>
                    <td><b>{{ $withdrawal_total }}</b></td>
                </tr>

                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('assets/js') }}/sweetalert2.min.js"></script>
    <script src="{{ asset('assets/js') }}/toastr.min.js"></script>
@endpush

@push('scripts')
@if (session('success'))
<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });


        Toast.fire({
            icon: 'success',
            title: @json(session('success'))
        })

    })
</script>
@endif
@endpush