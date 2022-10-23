<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('All Roles') }}</h3>

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
                        <th>{{ __('Permission') }}</th>
                        <th>{{ __('Created at') }}</th>
                        <th>{{ __('Updated at') }}</th>
                        <th>{{ __('Settings') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($roles) == 0)
                        <tr>
                            <td colspan="6">
                                <center>
                                    {{ __('No items found ..... ') }}
                                </center>
                            </td>
                        </tr>
                    @endif
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('role.permissions', Crypt::encrypt($role->id)) }}"
                                        class="btn btn-block btn-outline-primary btn-flat">
                                        <small>- {{ $role->permissions_count }} -</small>
                                        {{ __('Permissions') }}
                                    </a>
                                </div>
                            </td>
                            <td>{{ $role->created_at->diffForHumans() }}</td>
                            <td>{{ $role->updated_at->diffForHumans() }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" onclick="confirmDestroy({{ $role->id }}, this)"
                                        class="btn btn-danger btn-flat">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <a href="{{ route('roles.edit', Crypt::encrypt($role->id)) }}"
                                        class="btn btn-primary btn-flat">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr wire:loading>
                        <td colspan="6">
                            <center>
                                {{__('Searching for items .... ')}}
                            </center>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
