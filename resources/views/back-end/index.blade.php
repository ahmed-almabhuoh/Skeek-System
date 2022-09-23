@extends('back-end.parent')

@section('title', __('Dashboard'))
@section('location', __('Dashboard'))
@section('index', __('Index'))

@section('styles')

@endsection

@section('aside-items')

    <li class="nav-header">{{__('Human Resources')}}</li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fa fa-globe"></i>
            <p>
                {{__('Countries')}}
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('countries.create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{__('Add Country')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('countries.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{__('Browse Countries')}}</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fa fa-handshake"></i>
            <p>
                {{ __('Banks') }}
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('banks.create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('Add bank') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('banks.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('Browse bank') }}</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-header">{{__('Sheeks Info')}}</li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fa fa-handshake"></i>
            <p>
                {{ __('Sheeks') }}
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('sheeks.create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('Create sheek') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('sheeks.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('Index') }}</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-header">{{__('Settings')}}</li>
    {{-- Change password --}}
    <li class="nav-item">
        <a href="{{ route('password.change') }}" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>{{__('Change password')}}</p>
        </a>
    </li>
    {{-- Logout --}}
    <li class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>{{__('Logout')}}</p>
        </a>
    </li>
@endsection

@section('content')

@endsection

@section('scripts')

@endsection
