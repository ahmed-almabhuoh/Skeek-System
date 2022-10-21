<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('All currancies') }}</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right"
                            placeholder="{{ __('Search') }}" wire:model="searchTerm">

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
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Created at') }}</th>
                            <th>{{ __('Updated at') }}</th>
                            @canany(['Update-Currancy', 'Delete-Currancy'])
                                <th>{{ __('Settings') }}</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($currancies) == 0)
                            <tr>
                                <td colspan="6">
                                    <center>
                                        No items found ....
                                    </center>
                                </td>
                            </tr>
                        @endif
                        @foreach ($currancies as $currancy)
                            <tr>
                                <td>{{ $currancy->id }}</td>
                                <td>{{ $currancy->name }}</td>
                                <td><span
                                        class="badge @if (!$currancy->active) bg-danger @else bg-success @endif">
                                        @if ($currancy->active)
                                            {{ __('Active') }}
                                        @else
                                            {{ __('In-active') }}
                                        @endif
                                    </span>
                                </td>
                                <td>{{ $currancy->created_at }}</td>
                                <td>{{ $currancy->updated_at }}</td>
                                @canany(['Update-Currancy', 'Delete-Currancy'])
                                    <td>
                                        <div class="btn-group">
                                            @can('Update-Currancy')
                                                <a href="{{ route('currancies.edit', Crypt::encrypt($currancy->id)) }}"
                                                    class="btn btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan

                                            @can('Delete-Currancy')
                                                <button type="button" onclick="confirmDestroy({{ $currancy->id }}, this)"
                                                    class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endcan

                                            <button type="button" class="btn btn-default" data-toggle="modal"
                                                data-target="#currancy-view-modal"
                                                onclick="currancy_show('{{ Crypt::encrypt($currancy->id) }}', '{{ route('currancies.edit', Crypt::encrypt($currancy->id)) }}')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                @endcanany
                            </tr>
                            <tr wire:loading>
                                <td colspan="6">
                                    <center>
                                        Processing Payment...
                                    </center>
                                </td>
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
