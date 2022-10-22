@extends('back-end.supers.dashboard')

@section('super-title', __('Super Users'))
@section('super-location', __('Dashboard'))
@section('super-index', __('Follow User Actions'))

@section('super-styles')

    @livewireStyles
@endsection

@section('super-content')
    <div class="container-fluid">
        <div class="row">
            @livewire('follow-up-user-search', [
                'admin' => $admin,
                'userLogs' => $userLogs,
            ])
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('super-scripts')

    @livewireScripts
@endsection
