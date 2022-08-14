@extends('back-end.supers.parent')

@section('super-title', 'Super Dashboard')
@section('super-location', 'Dashboard')
@section('super-index', 'Super Dashboard')


@section('super-styles')

@endsection

@section('super-aside-items')

    @canany(['Create-Country', 'Read-Country', 'Update-Country', 'Delete-Country', 'Create-Bank', 'Read-Bank',
        'Update-Bank', 'Delete-Bank', 'Create-Cuurancy', 'Read-Cuurancy', 'Update-Cuurancy', 'Delete-Cuurancy'])
        <li class="nav-header">Content Management</li>

        @canany(['Create-Country', 'Read-Country', 'Update-Country', 'Delete-Country'])
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Countries
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    @can('Read-Country')
                        <li class="nav-item">
                            <a href="{{ route('countries.static_show') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All</p>
                            </a>
                        </li>
                    @endcan

                    @can('Create-Country')
                        <li class="nav-item">
                            <a href="{{ route('countries.statis_create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @canany(['Create-Bank', 'Read-Bank', 'Update-Bank', 'Delete-Bank'])
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Banks
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    @can('Read-Bank')
                        <li class="nav-item">
                            <a href="{{ route('banks.static_index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All</p>
                            </a>
                        </li>
                    @endcan

                    @can('Create-Bank')
                        <li class="nav-item">
                            <a href="{{ route('banks.static_create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @canany(['Create-Cuurancy', 'Read-Cuurancy', 'Update-Cuurancy', 'Delete-Cuurancy'])
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Currancy
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>

                @can('Read-Cuurancy')
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('currancies.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All</p>
                            </a>
                        </li>
                    @endcan

                    @can('Create-Cuurancy')
                        <li class="nav-item">
                            <a href="{{ route('currancies.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany
    @endcanany

    @canany(['Create-Super', 'Read-Super', 'Update-Super', 'Delete-Super', 'Create-User', 'Read-User', 'Update-User',
        'Delete-User'])
        <li class="nav-header">Humman Recourses</li>

        @canany(['Create-Super', 'Read-Super', 'Update-Super', 'Delete-Super'])
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Supers
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    @can('Read-Super')
                        <li class="nav-item">
                            <a href="{{ route('super.super_index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All</p>
                            </a>
                        </li>
                    @endcan

                    @can('Create-Super')
                        <li class="nav-item">
                            <a href="{{ route('super.super_create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @canany(['Create-User', 'Read-User', 'Update-User', 'Delete-User'])
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Users
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    @can('Read-User')
                        <li class="nav-item">
                            <a href="{{ route('super.user_show') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All</p>
                            </a>
                        </li>
                    @endcan

                    @can('Create-User')
                        <li class="nav-item">
                            <a href="{{ route('super.user_add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany
    @endcanany


    @if (auth('super')->user()->email == 'sheek.system.22@gmail.com' || auth()->user()->email == 'az54546@gmail.com')
        <li class="nav-header">Roles & Permissions</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Roles
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('roles.create') }}" class="nav-link">
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
                    Permissions
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="{{ route('permissions.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('permissions.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create</p>
                    </a>
                </li>
            </ul>
        </li>
    @endif

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
