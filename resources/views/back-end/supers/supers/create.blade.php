@extends('back-end.supers.dashboard')

@section('super-title', __('Add new super'))
@section('super-location', __('supers'))
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
                <h3 class="card-title">{{__('Add New Super')}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('super.super_store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="role_id" class="col-sm-2 col-form-label">{{__('Role name')}}</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="role_id"
                                style="@error('role_id') border-color: red; @enderror">
                                <option value="0">*</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <SMAll style="color: red">
                                    {{ $message }}
                                </SMAll>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">{{__('Full name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{ old('name') }}" placeholder="{{__('Enter super full name')}}"
                                style="@error('name') border-color: red; @enderror">
                            @error('name')
                                <SMAll style="color: red">
                                    {{ $message }}
                                </SMAll>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">{{__('Email')}}</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="email"
                                value="{{ old('email') }}" style="@error('email') border-color: red; @enderror"
                                placeholder="{{__('Enter super email')}}">
                            @error('email')
                                <SMAll style="color: red">
                                    {{ $message }}
                                </SMAll>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">{{__('Password')}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="password" class="form-control" id="password"
                                style="@error('password') border-color: red; @enderror" placeholder="{{__('Enter super password')}}"
                                value="{{ $password }}">
                            @error('password')
                                <SMAll style="color: red">
                                    {{ $message }}
                                </SMAll>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="active" checked>
                                <label class="form-check-label" for="active">{{__('is Active!')}}</label>
                            </div>
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
