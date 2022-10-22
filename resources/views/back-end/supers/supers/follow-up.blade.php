@extends('back-end.supers.dashboard')

@section('super-title', __('Super Actions'))
@section('super-location', __('Dashboard'))
@section('super-index', __('Follow Super Actions'))

@section('super-styles')

    @livewireStyles
@endsection

@section('super-content')
    <div class="container-fluid">
        <div class="row">
            @livewire('follow-up-super-search', [
                'super' => $super,
                'super_logs' => $super_logs,
            ])
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('super-scripts')

    @livewireScripts
@endsection
