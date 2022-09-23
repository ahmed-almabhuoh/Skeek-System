@extends('back-end.supers.parent')

@section('super-title', 'Super Dashboard')
@section('super-location', 'Dashboard')
@section('super-index', 'Super Dashboard')


@section('super-styles')

@endsection

@section('super-aside-items')

    @canany(['Create-Country', 'Read-Country', 'Update-Country', 'Delete-Country', 'Create-Bank', 'Read-Bank',
        'Update-Bank', 'Delete-Bank', 'Create-Cuurancy', 'Read-Cuurancy', 'Update-Cuurancy', 'Delete-Cuurancy'])
        <li class="nav-header">{{__('Content Management')}}</li>

        @canany(['Create-Country', 'Read-Country', 'Update-Country', 'Delete-Country'])
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        {{__('Countries')}}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    @canany(['Read-Country', 'Update-Country', 'Delete-Country'])
                        <li class="nav-item">
                            <a href="{{ route('countries.static_show') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('All')}}</p>
                            </a>
                        </li>
                    @endcanany

                    @can('Create-Country')
                        <li class="nav-item">
                            <a href="{{ route('countries.statis_create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('Create')}}</p>
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
                        {{__('Banks')}}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    @canany(['Read-Bank', 'Update-Bank', 'Delete-Bank'])
                        <li class="nav-item">
                            <a href="{{ route('banks.static_index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('All')}}</p>
                            </a>
                        </li>
                    @endcanany

                    @can('Create-Bank')
                        <li class="nav-item">
                            <a href="{{ route('banks.static_create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('Create')}}</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @canany(['Create-Currancy', 'Read-Currancy', 'Update-Currancy', 'Delete-Currancy'])
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        {{__('Currancy')}}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview" style="display: none;">
                    @canany(['Read-Currancy', 'Update-Currancy', 'Delete-Currancy'])
                        <li class="nav-item">
                            <a href="{{ route('currancies.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('All')}}</p>
                            </a>
                        </li>
                    @endcanany

                    @can('Create-Currancy')
                        <li class="nav-item">
                            <a href="{{ route('currancies.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('Create')}}</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany
    @endcanany

    @canany(['Create-Super', 'Read-Super', 'Update-Super', 'Delete-Super', 'Create-User', 'Read-User', 'Update-User',
        'Delete-User'])
        <li class="nav-header">{{__('Humman Recourses')}}</li>

        @canany(['Create-Super', 'Read-Super', 'Update-Super', 'Delete-Super'])
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        {{__('Supers')}}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    @canany(['Read-Super', 'Update-Super', 'Delete-Super'])
                        <li class="nav-item">
                            <a href="{{ route('super.super_index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('All')}}</p>
                            </a>
                        </li>
                    @endcanany

                    @can('Create-Super')
                        <li class="nav-item">
                            <a href="{{ route('super.super_create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('Create')}}</p>
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
                        {{__('Users')}}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    @canany(['Read-User', 'Update-User', 'Delete-User'])
                        <li class="nav-item">
                            <a href="{{ route('super.user_show') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('All')}}</p>
                            </a>
                        </li>
                    @endcanany

                    @can('Create-User')
                        <li class="nav-item">
                            <a href="{{ route('super.user_add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('Create')}}</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany
    @endcanany


    @if (auth('super')->user()->email == 'sheek.system.22@gmail.com' || auth()->user()->email == 'az54546@gmail.com')
        <li class="nav-header">{{__('Roles & Permissions')}}</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    {{__('Roles')}}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{__('All')}}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('roles.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{__('Create')}}</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    {{__('Permissions')}}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="{{ route('permissions.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{__('All')}}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('permissions.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{__('Create')}}</p>
                    </a>
                </li>
            </ul>
        </li>
    @endif

    <li class="nav-header">{{__('Settings')}}</li>
    {{-- Logout --}}
    <li class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{__('Logout')}}</p>
        </a>
    </li>
@endsection

@section('super-content')

@endsection

@section('super-scripts')

@endsection
