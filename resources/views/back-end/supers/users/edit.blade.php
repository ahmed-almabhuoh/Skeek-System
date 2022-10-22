@extends('back-end.supers.dashboard')

@section('super-title', __('Edit user info'))
@section('super-location', __('Users'))
@section('super-index', __('Edit'))


@section('super-styles')

    @livewireStyles
@endsection

@section('super-content')
    <div class="col-md-12">
        <div class="card card-info">
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-header">
                <h3 class="card-title">{{ __('Update user info') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('super.admins_update', Crypt::encrypt($admin->id)) }}">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">{{ __('Full user name') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{ $admin->name }}" placeholder="{{ __('Enter user full name') }}" name="name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">{{ __('User E-mail') }}</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="email"
                                value="{{ $admin->email }}" name="email" placeholder="{{ __('Enter user e-mail') }}">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">{{ __('Password') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="password" class="form-control" id="password" name="password"
                                placeholder="{{ __('Enter user password') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="password_generator"
                                    name="password_generator" wire:model="usePasswordGenerator">
                                <label class="form-check-label"
                                    for="password_generator">{{ __('User password generator') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="active" name="active"
                                    checked="">
                                <label class="form-check-label" for="active"> {{ __('Active ?!') }}</label>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">{{ __('Update') }}</button>
                    <button type="reset" class="btn btn-default float-right">{{ __('Cancel') }}</button>
                </div>
                <!-- /.card-footer -->
            </form>

            <!-- Livewire Component wire-end:cGhtQgDfhoDvdLAApvjQ -->
        </div>
    </div>
@endsection

@section('super-scripts')

    @livewireScripts
@endsection
