<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('All static banks') }}</h3>

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
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Country') }}</th>
                            <th>{{ __('City') }}</th>
                            <th>{{ __('Currancy') }}</th>
                            <th>{{ __('Updated at') }}</th>
                            <th>{{ __('Created at') }}</th>
                            <th>{{ __('Status') }}</th>
                            @canany(['Update-Bank', 'Delete-Bank'])
                                <th>{{ __('Settings') }}</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @if (!count($banks))
                            <td colspan="10">
                                <center>{{ __('No data found ... ') }}</center>
                            </td>
                        @endif
                        @foreach ($banks as $bank)
                            <tr>
                                <td>{{ $bank->id }}</td>
                                <td>
                                    @php
                                        $img = $bank->img;
                                    @endphp
                                    @if (!is_null($img))
                                        <img src="{{ Storage::url('public/img/' . $bank->img) }}" width="40px"
                                            height="40px" alt="No image">
                                    @else
                                        {{ __('No image') }}
                                    @endif
                                </td>
                                <td>{{ $bank->name }}</td>
                                <td>
                                    @foreach ($countries as $country)
                                        @if ($country->id == $bank->country_id)
                                            {{ $country->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $bank->city }}</td>
                                <td>
                                    @foreach ($currancies as $currancy)
                                        @if ($currancy->id == $bank->currancy_id)
                                            {{ $currancy->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $bank->created_at }}</td>
                                <td>{{ $bank->updated_at }}</td>
                                <td><span
                                        class="badge @if (!$bank->active) bg-danger @else bg-success @endif">
                                        @if ($bank->active)
                                            {{ __('Active') }}
                                        @else
                                            {{ __('In-active') }}
                                        @endif
                                    </span>
                                </td>
                                @canany(['Update-Bank', 'Delete-Bank'])
                                    <td>
                                        <div class="btn-group">
                                            @can('Update-Bank')
                                                <a href="{{ route('banks.static_edit', Crypt::encrypt($bank->id)) }}"
                                                    class="btn btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan

                                            @can('Delete-Bank')
                                                <button type="button"
                                                    onclick="confirmDestroy('{{ Crypt::encrypt($bank->id) }}', this)"
                                                    class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endcan

                                            <button type="button" class="btn btn-default" data-toggle="modal"
                                                data-target="#bank-view-modal"
                                                onclick="bank_show('{{ Crypt::encrypt($bank->id) }}', '{{ Storage::url('public/img/') }}', '{{ route('banks.static_update', Crypt::encrypt($bank->id)) }}')">
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
    {{ $banks->links() }}
</div>
