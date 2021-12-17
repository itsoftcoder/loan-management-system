@extends('layouts.app')

@section('title')
    Manage branch Holiday
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
          <h1>Branch Holiday Page</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('branch-holiday.create',$id) }}">Create New Branch Holiday</a></li>
              <li class="breadcrumb-item active">Branch Holiday List Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
@endsection

@section('content')
<!-- Widget: user widget style 2 -->
<div class="card card-widget widget-user-2">
    <div class="card-footer p-0">
      <ul class="nav flex-column">
        <li class="nav-item">
          <span class="nav-link text-maroon">
            Friday Is Holiday <span class="float-right">
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input"
                        {{ $branch->friday_is_holiday == 1 ? 'checked' : '' }} data-id="{{ $id }}"
                        id="friday_is_holiday">
                    <label class="custom-control-label" for="friday_is_holiday"
                        id="friday_is_holiday-label">{{ $branch->friday_is_holiday == 1 ? 'Yes' : 'No' }}</label>
                </div>
            </span>
          </span>
        </li>

        <li class="nav-item">
            <span class="nav-link text-maroon">
              Saturday Is Holiday <span class="float-right">
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input"
                        {{ $branch->saturday_is_holiday == 1 ? 'checked' : '' }} data-id="{{ $id }}"
                        id="saturday_is_holiday">
                    <label class="custom-control-label" for="saturday_is_holiday"
                        id="saturday_is_holiday-label">{{ $branch->saturday_is_holiday == 1 ? 'Yes' : 'No' }}</label>
                </div>
                </span>
            </span>
        </li>

        <li class="nav-item">
        <span class="nav-link text-maroon">
            Sunday Is Holiday <span class="float-right">
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input"
                        {{ $branch->sunday_is_holiday == 1 ? 'checked' : '' }} data-id="{{ $id }}"
                        id="sunday_is_holiday">
                    <label class="custom-control-label" for="sunday_is_holiday"
                        id="sunday_is_holiday-label">{{ $branch->sunday_is_holiday == 1 ? 'Yes' : 'No' }}</label>
                </div>
                </span>
            </span>
            </span>
        </span>
        </li>
      </ul>
    </div>
  </div>
  <!-- /.widget-user -->
<div class="card">
    <div class="card-header clearfix">
        <h3 class="card-title float-left align-middle my-0">Branch Holiday Table</h3>
        <a href="{{ route('branch-holiday.create',$id) }}" class="btn btn-xs btn-secondary float-right"><i
                class="fa fa-plus"></i> Create New Branch Holiday</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Holiday Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($branch->holidays as $branch_holiday)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $branch_holiday->holiday_date }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('branch-holiday.edit',$branch_holiday->id)}}"
                                    class="btn btn-xs btn-primary">Edit</a>
                                <a href="" class="btn btn-xs btn-danger">Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
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
<script>
    $(document).ready(function() {

        $('#friday_is_holiday').change(function() {
            if ($(this).prop('checked')) {
                $('#friday_is_holiday-label').html('Yes');
                $.ajax({
                    url: @json(route('branch-holiday.change-friday-is-holiday')),
                    method: 'GET',
                    data: {
                        id: $(this).data('id'),
                        friday_is_holiday: '1'
                    },
                    success: function(response) {
                        if (response.success) {
                            var Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000
                            });


                            Toast.fire({
                                icon: 'success',
                                title: response.success
                            })
                            // window.location.reload()
                        }
                    }
                })
            } else {
                $('#friday_is_holiday-label').html('No');

                $.ajax({
                    url: @json(route('branch-holiday.change-friday-is-holiday')),
                    method: 'GET',
                    data: {
                        id: $(this).data('id'),
                        friday_is_holiday: '0'
                    },
                    success: function(response) {
                        if (response.success) {
                            var Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000
                            });


                            Toast.fire({
                                icon: 'success',
                                title: response.success
                            })
                           
                        }
                    }
                })
            }
        })



        $('#saturday_is_holiday').change(function() {
            if ($(this).prop('checked')) {
                $('#saturday_is_holiday-label').html('Yes');
                $.ajax({
                    url: @json(route('branch-holiday.change-saturday-is-holiday')),
                    method: 'GET',
                    data: {
                        id: $(this).data('id'),
                        saturday_is_holiday: '1'
                    },
                    success: function(response) {
                        if (response.success) {
                            var Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000
                            });


                            Toast.fire({
                                icon: 'success',
                                title: response.success
                            })
                           
                        }
                    }
                })
            } else {
                $('#saturday_is_holiday-label').html('No');

                $.ajax({
                    url: @json(route('branch-holiday.change-saturday-is-holiday')),
                    method: 'GET',
                    data: {
                        id: $(this).data('id'),
                        saturday_is_holiday: '0'
                    },
                    success: function(response) {
                        if (response.success) {
                            var Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000
                            });


                            Toast.fire({
                                icon: 'success',
                                title: response.success
                            })
                            
                        }
                    }
                })
            }
        })




        $('#sunday_is_holiday').change(function() {
            if ($(this).prop('checked')) {
                $('#sunday_is_holiday-label').html('Yes');
                $.ajax({
                    url: @json(route('branch-holiday.change-sunday-is-holiday')),
                    method: 'GET',
                    data: {
                        id: $(this).data('id'),
                        sunday_is_holiday: '1'
                    },
                    success: function(response) {
                        if (response.success) {
                            var Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000
                            });


                            Toast.fire({
                                icon: 'success',
                                title: response.success
                            })
                           
                        }
                    }
                })
            } else {
                $('#sunday_is_holiday-label').html('No');

                $.ajax({
                    url: @json(route('branch-holiday.change-sunday-is-holiday')),
                    method: 'GET',
                    data: {
                        id: $(this).data('id'),
                        sunday_is_holiday: '0'
                    },
                    success: function(response) {
                        if (response.success) {
                            var Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000
                            });


                            Toast.fire({
                                icon: 'success',
                                title: response.success
                            })
                           
                        }
                    }
                })
            }
        })


    })
</script>
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