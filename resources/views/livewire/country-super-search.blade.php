<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('All static countries') }}</h3>

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
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Created at') }}</th>
                            <th>{{ __('Updated at') }}</th>
                            @canany(['Update-Country', 'Delete-Country'])
                                <th>{{ __('Settings') }}</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @if (!count($countries))
                            <td colspan="6">{{ __('No data found ... ') }}</td>
                        @endif
                        @foreach ($countries as $country)
                            <tr>
                                <td>{{ $country->id }}</td>
                                <td>{{ $country->name }}</td>
                                <td>{{ $country->created_at }}</td>
                                <td>{{ $country->updated_at }}</td>
                                <td><span
                                        class="badge @if (!$country->active) bg-danger @else bg-success @endif">
                                        @if ($country->active)
                                            {{ __('Active') }}
                                        @else
                                            {{ __('In-active') }}
                                        @endif
                                    </span>
                                </td>
                                @canany(['Update-Country', 'Delete-Country'])
                                    <td>
                                        <div class="btn-group">
                                            @can('Update-Country')
                                                <a href="{{ route('country.statis_edit', Crypt::encrypt($country->id)) }}"
                                                    class="btn btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan

                                            @can('Delete-Country')
                                                <button type="button"
                                                    onclick="confirmDestroy('{{ Crypt::encrypt($country->id) }}', this)"
                                                    class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endcan

                                            <button type="button" class="btn btn-default" data-toggle="modal"
                                                data-target="#country-view-modal"
                                                onclick="country_show('{{ Crypt::encrypt($country->id) }}', '{{ route('country.statis_edit', Crypt::encrypt($country->id)) }}')">
                                                <i class="fas fa-eye"></i>
                                            </button>
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
    {{ $countries->links() }}
</div>
