@extends('layouts.app')

@section('title')
    Edit Branch Capital
@endsection

@section('breadcrumb')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Branch Capital Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('branch-capital.index', $branch_capital->branch_id) }}">List Branch
                                Capital</a></li>
                        <li class="breadcrumb-item active">Edit Branch Capital Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
    <div class="card">
        <div class="card-header clearfix">
            <h3 class="card-title">Edit Branch Capital</h3>
            <a href="{{ route('branch-capital.index', $branch_capital->branch_id) }}" class="btn btn-xs btn-danger float-right">Branch Capital
                List</a>
        </div>
        <div class="card-body">
            <form action="{{ route('branch-capital.update', $branch_capital->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-10 mx-auto">

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label">Date</label>
                            <div class="col-md-8">
                                <input type="date" name="date" value="{{ $branch_capital->capital_date ?? old('date') }}"
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

                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label">Amount</label>
                            <div class="col-md-8">
                                <input type="number" name="amount"
                                    class="form-control @error('amount') is-invalid @enderror" value="{{ $branch_capital->capital_amount ?? old('amount') }}"
                                    id="amount" placeholder="amount" />
                                @error('amount')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="capital_type" class="col-md-4 col-form-label">Capital Type</label>
                            <div class="col-md-8">
                                <select class="form-control" id="capital_type" name="capital_type">
                                    @php
                                        $capital_types = ['deposit', 'withdrawal'];
                                    @endphp
                                    @foreach ($capital_types as $capital_type)
                                        <option value="{{ $capital_type }}"
                                            {{ $branch_capital->capital_type == $capital_type ||  old('capital_type') == $capital_type ? 'selected' : '' }}>
                                            {{ $capital_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label">Description</label>
                            <div class="col-md-8">
                                <input type="text" value="{{ $branch_capital->description ?? old('description') }}" name="description"
                                    class="form-control @error('start_capital')
                                      is-invalid
                                  @enderror"
                                    id="description" placeholder="description" />

                                @error('description')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label">Status</label>
                            <div class="col-md-8">
                                <select class="form-control" id="status" name="status">
                                    @php
                                        $statuses = ['completed', 'pending', 'cancel'];
                                    @endphp
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}"
                                            {{ $branch_capital->status == $status ?? old('status') == $status ? 'selected' : '' }}>{{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label"></label>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-outline-success">Update Branch Capital</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>



        </div>
    </div>
@endsection
