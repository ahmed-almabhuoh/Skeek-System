@extends('back-end.parent')

@section('title', __('cms.dashboard'))
@section('location', __('cms.dashboard'))
@section('index', __('cms.index'))

@section('styles')

@endsection

@section('aside-items')

    <li class="nav-header">Humman Recourses</li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fa fa-handshake"></i>
            <p>
                Countries
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('countries.create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Country</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('countries.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Browse Countries</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-header">Sheeks Info</li>
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
                <a href="{{ route('sheeks.create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('cms.add') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('sheeks.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('cms.index') }}</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-header">Settings</li>
    {{-- Change password --}}
    <li class="nav-item">
        <a href="{{ route('password.change') }}" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>Change password</p>
        </a>
    </li>
    {{-- Logout --}}
    <li class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
        </a>
    </li>
@endsection

@section('content')

@endsection

@section('scripts')

@endsection
