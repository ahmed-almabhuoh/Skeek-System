@extends('back-end.supers.dashboard')

@section('super-title', __('Add new role'))
@section('super-location', __('Roles'))
@section('super-index', __('Add'))


@section('super-styles')

@endsection

@section('super-content')
    @if (session('code') == 200)
        <div class="card-body">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> {{__('Success!')}}</h5>
                {{ session('status') }}
            </div>
        </div>
    @elseif (session('code') == 500)
        <div class="card-body">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> {{__('Failed!')}}</h5>
                {{ session('status') }}
            </div>
        </div>
    @endif
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">{{__('Add new role')}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('roles.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">{{__('Role name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{ old('name') }}" placeholder="{{__('Enter role name')}}"
                                style="@error('name') border-color: red; @enderror">
                            @error('name')
                                <SMAll style="color: red">
                                    {{ $message }}
                                </SMAll>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="guard" class="col-sm-2 col-form-label">{{__('For Guard')}}</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="guard" style="@error('guard') border-color: red; @enderror">
                                <option value="0">*</option>
                                <option value="super">Super Admin</option>
                            </select>
                            @error('guard')
                                <SMAll style="color: red">
                                    {{ $message }}
                                </SMAll>
                            @enderror
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">{{__('Create')}}</button>
                    <button type="reset" class="btn btn-default float-right">{{__('Cancel')}}</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
@endsection

@section('super-scripts')

@endsection
