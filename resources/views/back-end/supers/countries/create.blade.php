@extends('back-end.supers.dashboard')

@section('super-title', __('Create static countries'))
@section('super-location', __('Static countries'))
@section('super-index', __('Create'))


@section('super-styles')

    @livewireStyles
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
                            <h3 class="card-title">{{ __('Add static country') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @livewire('add-static-country-with-disable-submittion')
                        <!-- /.card-body -->


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

    @livewireScripts
@endsection
