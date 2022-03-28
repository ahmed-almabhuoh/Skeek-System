@extends('back-end.parent')

@section('title', __('cms.dashboard'))
@section('location', __('cms.dashboard'))
@section('index', __('cms.index'))

@section('styles')

@endsection

@section('aside-items')
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fa fa-handshake"></i>
            <p>
                {{ __('cms.sheeks') }}
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{route('sheeks.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('cms.add') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="pages/UI/general.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('cms.recived') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('sheeks.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('cms.index') }}</p>
                </a>
            </li>
        </ul>
    </li>
@endsection

@section('content')

@endsection

@section('scripts')

@endsection
