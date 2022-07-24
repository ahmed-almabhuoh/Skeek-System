@extends('back-end.supers.dashboard')

@section('super-title', 'Super Users')
@section('super-location', 'Dashboard')
@section('super-index', 'Follow User Actions')

@section('super-styles')

@endsection

@section('super-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $admin->name . ' actions' }}</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>IP</th>
                                    <th>OS</th>
                                    <th>Device</th>
                                    <th>Platform</th>
                                    <th>Browser</th>
                                    <th>V</th>
                                    <th>D-T</th>
                                    <th>Action</th>
                                    <th>At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userLogs as $userLog)
                                    <tr>
                                        <td>{{ $userLog->id }}</td>
                                        <td>{{ $userLog->ip }}</td>
                                        <td>{{ $userLog->os }}</td>
                                        <td>{{ $userLog->device }}</td>
                                        <td>{{ $userLog->platform_version }}</td>
                                        <td>
                                            {{ $userLog->browser }}
                                        </td>
                                        <td>
                                            {{ $userLog->browser_version }}
                                        </td>
                                        <td>
                                            @if ($userLog->isDesktop)
                                                {{ 'Desktop' }}
                                            @elseif ($userLog->isTablet)
                                                {{ 'Tablet' }}
                                            @elseif ($userLog->isPhone)
                                                {{ 'Phone' }}
                                            @elseif ($userLog->isRobot)
                                                {{ 'Robot' }}
                                            @endif
                                        </td>
                                        <td>{{ $userLog->action }}</td>
                                        <td>{{ $userLog->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('super-scripts')

@endsection
