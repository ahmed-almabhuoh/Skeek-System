@extends('back-end.supers.dashboard')

@section('super-title', __('Edit role'))
@section('super-location', __('Roles'))
@section('super-index', __('Edit'))


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
                <h3 class="card-title">{{__('Edit role')}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('roles.update', Crypt::encrypt($role->id)) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row" style="display: none;">
                        <input type="text" name="id" class="form-control" id="name"
                            value="{{ Crypt::encrypt($role->id) }}" placeholder="{{__('Enter role id')}}">

                    </div>


                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">{{__('Role name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{ $role->name }}" placeholder="{{__('Enter role name')}}"
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
                            <select class="form-control" name="guard"
                                style="@error('guard') border-color: red; @enderror">
                                <option value="0">*</option>
                                <option value="super" @if ($role->guard_name == 'super') selected @endif>Super Admin
                                </option>
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
                    <button type="submit" class="btn btn-info">{{__('Update')}}</button>
                    <button type="reset" class="btn btn-default float-right">{{__('Cancel')}}</a>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
@endsection

@section('super-scripts')

@endsection
