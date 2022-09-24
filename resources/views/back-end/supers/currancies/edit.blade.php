@extends('back-end.supers.dashboard')

@section('super-title', __('Edit currancy'))
@section('super-location', __('currnacies'))
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
                            <h3 class="card-title">{{ __('Edit currancy') }}</h3>
                        </div>
                        <div style="margin: 15px">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create-form" method="POST"
                            action="{{ route('currancies.update', Crypt::encrypt($currancy->id)) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group" style="display: none;">
                                    <input type="text" name="id" class="form-control" id="id"
                                        placeholder="Enter bank id" value="{{ Crypt::encrypt($currancy->id) }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">{{ __('Currancy') }}</label>
                                    @error('name')
                                        <span style="margin-left: 15px;diplay: block; color: red;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="{{__('Enter currancy name')}}" value="{{ $currancy->name }}">
                                </div>

                                <!-- Livewire Component wire-end:W8rBrt6UaZnBPLgsFBGB -->
                                <div class="form-check">
                                    @error('active')
                                        <span style="margin-left: 15px;diplay: block; color: red;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <input type="checkbox" class="form-check-input" id="active" name="active"
                                        @if ($currancy->active) checked @endif>
                                    <label class="form-check-label" for="active">{{ __('Active') }}</label>
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
