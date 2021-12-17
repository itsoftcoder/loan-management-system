@extends('layouts.app')

@section('title')
    Branch List
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
                    <h1>Branch List Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('branch.create') }}">Create New Branch</a></li>
                        <li class="breadcrumb-item active">Branch List Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

@endsection

@section('content')
    <div class="card">
        <div class="card-header clearfix">
            <h3 class="card-title float-left align-middle my-0">Branch Table</h3>
            <a href="{{ route('branch.create') }}" class="btn btn-xs btn-secondary float-right"><i
                    class="fa fa-plus"></i> Create New Branch</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Branch Start Date</th>
                        <th>Branch Start Capital</th>
                        <th>Branch Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    
                    @foreach ($branches as $branch)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $branch->name }}</td>
                            <td>{{ $branch->start_date }}</td>
                            <td>{{ $branch->start_capital }}</td>
                            <td>
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input"
                                        {{ $branch->status == 1 ? 'checked' : '' }} data-id="{{ $branch->id }}"
                                        id="status">
                                    <label class="custom-control-label" for="status"
                                        id="status-label">{{ $branch->status == 1 ? 'Enabled' : 'Disabled' }}</label>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('branch-capital.index', $branch->id) }}"
                                        class="btn btn-xs btn-success">Manage Capital</a>
                                    <a href="{{ route('branch-holiday.index',$branch->id) }}" class="btn btn-xs btn-primary">Manage Holiday</a>
                                    <a href="" class="btn btn-xs btn-info">View Detail</a>
                                    <a href="{{ route('branch.edit', $branch->id) }}"
                                        class="btn btn-xs btn-secondary">Edit</a>
                                    <a href="" class="btn btn-xs btn-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="clearfix">
            {{ $branches->links() }}
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

            var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000
                        });
            $('#status').change(function() {
                if ($(this).prop('checked')) {
                    $('#status-label').html('Enabled');
                
                    $.ajax({
                        url: @json(route('branch.change-status')),
                        method: 'GET',
                        data: {
                            id: $(this).data('id'),
                            status: '1'
                        },
                        success: function(response) {
                           
                            if (response.success) {
                        
                                Toast.fire({
                                    icon: 'success',
                                    title: response.success
                                })
                              
                            }
                        }
                    })
                } else {
                    $('#status-label').html('Disabled');

                    $.ajax({
                        url: @json(route('branch.change-status')),
                        method: 'GET',
                        data: {
                            id: $(this).data('id'),
                            status: '0'
                        },
                        success: function(response) {
                            console.log(response)
                            if (response.success) {
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
