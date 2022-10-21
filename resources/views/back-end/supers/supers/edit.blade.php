@extends('back-end.supers.dashboard')

@section('super-title', __('Add new super'))
@section('super-location', __('supers'))
@section('super-index', __('Add'))


@section('super-styles')

    @livewireStyles
@endsection

@section('super-content')
    @if (session('code') == 200)
        <div class="card-body">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> {{ __('Success!') }}</h5>
                {{ session('status') }}
            </div>
        </div>
    @elseif (session('code') == 500)
        <div class="card-body">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> {{ __('Failed!') }}</h5>
                {{ session('status') }}
            </div>
        </div>
    @endif
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">{{ __('Add New Super') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @livewire('update-super-with-constraints', [
                'super' => $super,
            ])
        </div>
    </div>
@endsection

@section('super-scripts')

    @livewireScripts
@endsection
