<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('All Supers') }}</h3>

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
                        @canany(['Ban-Super', 'Follow-Up-Super', 'Update-Super', 'Delete-Super'])
                            <th>{{ __('Status') }}</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @if (count($supers) == 0)
                        <tr>
                            <td colspan="7">
                                <center>
                                    {{ __('No items found ...') }}
                                </center>
                            </td>
                        </tr>
                    @endif
                    @foreach ($supers as $super)
                        <tr>
                            <td>{{ $super->id }}</td>
                            <td>{{ $super->name }}</td>
                            <td>{{ $super->email }}</td>
                            <td>{{ $super->created_at->diffForHumans() }}</td>
                            <td>{{ $super->updated_at->diffForHumans() }}</td>
                            <td><span
                                    class="tag tag-success">{{ $super->active ? __('Un-Banned') : __('Banned') }}</span>
                            </td>
                            @canany(['Ban-Super', 'Follow-Up-Super', 'Update-Super', 'Delete-Super'])
                                <td>
                                    <div class="btn-group">
                                        @can('Delete-Super')
                                            <button type="button" onclick="confirmDestroy('{{ $super->id }}', this)"
                                                class="btn btn-danger btn-flat">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endcan

                                        @can('Ban-Super')
                                            <a href="{{ route('super.ban_super', $super->id) }}"
                                                class="btn btn-warning btn-flat">
                                                <i class="fa fa-ban" aria-hidden="true"></i>
                                            </a>
                                        @endcan

                                        @can('Update-Super')
                                            <a href="{{ route('super.super_edit', Crypt::encrypt($super->id)) }}"
                                                class="btn btn-primary btn-flat">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>
                                        @endcan

                                        @can('Follow-Up-Super')
                                            <a href="{{ route('super.follow_up_actions', Crypt::encrypt($super->id)) }}"
                                                class="btn btn-secondary btn-flat">
                                                <i class="fa fa-location-arrow"></i>
                                            </a>
                                        @endcan
                                    </div>
                                </td>
                            @endcanany
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
