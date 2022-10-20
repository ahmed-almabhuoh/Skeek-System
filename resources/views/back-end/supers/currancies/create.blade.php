@extends('back-end.supers.dashboard')

@section('super-title', __('Add new currancy'))
@section('super-location', __('currnacies'))
@section('super-index', __('Add'))


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
                            <h3 class="card-title">{{ __('Add currancy') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @livewire('add-constraints-for-currancy')
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
