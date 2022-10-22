<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('All Users') }}</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" wire:model="searchTerm"
                        placeholder="{{ __('Search') }}">

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
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('E-mail') }}</th>
                        <th>{{ __('Created at') }}</th>
                        <th>{{ __('Updated at') }}</th>
                        <th>{{ __('Status') }}</th>
                        @canany(['Ban-User', 'Follow-Up-User', 'Delete-User'])
                            <th>{{ __('Settings') }}</th>
                        @endcanany
                    </tr>
                </thead>

                <tbody>
                    @if (count($admins) == 0)
                        <tr>
                            <td colspan="7">
                                <center>
                                    {{ __('No items found .... ') }}
                                </center>
                            </td>
                        </tr>
                    @endif
                    @foreach ($admins as $admin)
                        <tr>
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->created_at->diffForHumans() }}</td>
                            <td>{{ $admin->updated_at->diffForHumans() }}</td>
                            <td><span
                                    class="tag tag-success">{{ $admin->active ? __('Un-Banned') : __('Banned') }}</span>
                            </td>
                            @canany(['Ban-User', 'Follow-Up-User', 'Delete-User'])
                                <td>
                                    <div class="btn-group">
                                        @can('Delete-Uer')
                                            <button type="button" onclick="confirmDestroy('{{ $admin->id }}', this)"
                                                class="btn btn-danger btn-flat">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endcan

                                        @can('Follow-Up-User')
                                            <a href="{{ route('super.user_follow_actions', $admin->id) }}"
                                                class="btn btn-danger btn-flat">
                                                <i class="fa fa-location-arrow"></i>
                                            </a>
                                        @endcan

                                        @can('Ban-User')
                                            <a href="{{ route('super.user_ban', $admin->id) }}"
                                                class="btn btn-danger btn-flat">
                                                <i class="fa fa-ban" aria-hidden="true"></i>
                                            </a>
                                        @endcan
                                    </div>
                                </td>
                            @endcanany
                        </tr>
                    @endforeach
                    <div>
                        <tr wire:loading>
                            <td wire:loading colspan="7">
                                <center>{{ __('No data found ... ') }}</center>
                            </td>
                        </tr>
                    </div>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    {{ $admins->links() }}
</div>
