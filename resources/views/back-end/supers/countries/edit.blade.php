@extends('back-end.supers.dashboard')

@section('super-title', __('Edit static countries'))
@section('super-location', __('Static countries'))
@section('super-index', __('Edit'))


@section('super-styles')

@endsection

@section('super-content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Edit static country') }}</h3>
                        </div>
                        @if ($errors->any())
                            <div style="margin: 15px">

                                @if (!session()->get('created'))
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-ban"></i> {{ session()->get('title') }}!</h5>
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                            </div>
                        @endif
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('country.statis_update', Crypt::encrypt($country->id)) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group" style="display: none;">
                                    <input type="text" class="form-control" id="id" name="id"
                                        placeholder="{{ __('Enter country id') }}"
                                        value="{{ Crypt::encrypt($country->id) }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    @error('name')
                                        <p class="text-danger" style="display: inline-block; padding: 0 0 0 10px;">
                                            {{ $message }}</p>
                                    @enderror
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="{{ __('Enter country name') }}" value="{{ $country->name }}">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="active" name="active"
                                        @if ($country->active) checked @endif>
                                    <label class="form-check-label" for="active">{{ __('Active') }}</label>
                                    @error('active')
                                        <p class="text-danger" style="display: inline-block; padding: 0 0 0 10px;">
                                            {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <input type="submit" value="{{ __('Update') }}" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('super-scripts')

@endsection
