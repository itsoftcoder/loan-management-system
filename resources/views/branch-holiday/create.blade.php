@extends('layouts.app')

@section('title')
    Create Branch Holiday
@endsection



@section('breadcrumb')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Branch Holiday Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('branch-holiday.index', $id) }}">List Branch
                                Holidy</a></li>
                        <li class="breadcrumb-item active">Create Branch Holiday Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
    <div class="card">
        <div class="card-header clearfix">
            <h3 class="card-title">Create Branch Holiday</h3>
            <a href="{{ route('branch-holiday.index', $id) }}" class="btn btn-xs btn-primary float-right">Branch Holiday
                List</a>
        </div>
        <div class="card-body">
            <form action="{{ route('branch-holiday.store', $id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-10 mx-auto">

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label">Date</label>
                            <div class="col-md-8">
                                <input type="date" name="date" value="{{ old('date') }}"
                                    class="form-control @error('date')
                                      is-invalid
                                  @enderror"
                                    id="date" placeholder="date" />
                                   
                                                                      
                                @error('date')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>


                        
                          <!-- /.input group -->



                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label"></label>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-outline-success">Save Branch Holiday</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>



        </div>
    </div>
@endsection


