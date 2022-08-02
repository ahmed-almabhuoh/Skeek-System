@extends('back-end.supers.parent')

@section('super-title', 'Super Dashboard')
@section('super-location', 'Dashboard')
@section('super-index', 'Super Dashboard')


@section('super-styles')

@endsection

@section('super-aside-items')

    <li class="nav-header">Content Management</li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
                Countries
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
                <a href="{{ route('countries.static_show') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('countries.statis_create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
                Banks
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
                <a href="{{ route('banks.static_index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('banks.static_create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
                Currancy
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
                <a href="{{ route('currancies.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('currancies.create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-header">Humman Recourses</li>

    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
                Users
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
                <a href="{{ route('super.user_show') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-header">Settings</li>
    {{-- Logout --}}
    <li class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Logout</p>
        </a>
    </li>
@endsection

@section('super-content')

@endsection

@section('super-scripts')

@endsection
