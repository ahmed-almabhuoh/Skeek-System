<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $admin->name . ' actions' }}</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search"
                        wire:model="searchIP">

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
                        <th>#</th>
                        <th>{{ __('IP') }}</th>
                        <th>{{ __('OS') }}</th>
                        <th>{{ __('Device') }}</th>
                        <th>{{ __('Platform') }}</th>
                        <th>{{ __('Browser') }}</th>
                        <th>{{ __('V') }}</th>
                        <th>{{ __('D-T') }}</th>
                        <th>{{ __('Action') }}</th>
                        <th>{{ __('At') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($userLogs) == 0)
                        <tr>
                            <td colspan="10">
                                <center>
                                    {{ __('No logs for this user yet ....') }}
                                </center>
                            </td>
                        </tr>
                    @endif
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
    {{ $userLogs->links() }}
</div>
