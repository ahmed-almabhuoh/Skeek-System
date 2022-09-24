@extends('back-end.supers.dashboard')

@section('super-title', __('Static countries'))
@section('super-location', __('Dashboard'))
@section('super-index', __('Static countries'))


@section('super-styles')

@endsection

@section('super-content')

    <div class="container-fluid">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            {{ __('New Country') }}
        </button>

        <form action="{{ route('report.countries') }}" method="GET" style="display: inline;">
            <button type="submit" class="btn btn-default">
                {{ __('Export country report') }}
            </button>
        </form>
        <div style="margin: 10px"></div>
        @if (session()->get('created'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> {{ session()->get('title') }}!</h5>
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('All static countries') }}</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
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
        </div>
        <!-- /.row -->
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Add new static country') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('countries.statis_create') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>{{ __('After you add this static country with active status, it\'ll be usable for all users in systems') }}&hellip;
                        </p>
                        <div class="form-group">

                            <label for="name"
                                @error('name')
                                style="color: red;"
                            @enderror>{{ __('Country name') }}</label>
                            <input type="text" class="form-control" id="name" name="name"
                                @error('name')
                                    style="border-color: red" 
                                    @enderror
                                placeholder="{{ __('Enter country name') }}" value="{{ old('name') }}">
                            @error('name')
                                <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <!-- select -->
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="active" name="active">
                                    <label for="active" class="custom-control-label">{{ __('Active ?!') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">

                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Insert') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="country-view-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Status country detail') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @csrf
                <div class="modal-body">
                    <p>{{ __('This is a static country is usable for all users in the system with active status') }}
                        <br> {{ __('If you need to change its settings') }} <a id="country_edit_link"
                            href="">{{ __('Go to its edit view') }}</a>&hellip;
                    </p>
                    <div class="form-group">

                        <label for="name">{{ __('Country name') }}</label>
                        <input type="text" class="form-control" id="country_name" name="country_name"
                            placeholder="Enter country name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('Created at') }}</label>
                        <input type="text" class="form-control" id="country_created_at" name="country_created_at"
                            placeholder="Enter country name" readonly>
                    </div>
                    {{-- <div class="form-group">
                        <label for="name">Created from</label>
                        <input type="text" class="form-control" id="country_created_at" name="country_created_from"
                            placeholder="Enter country name" readonly>
                    </div> --}}
                    <div class="form-group">
                        <label for="name">{{ __('Updated at') }}</label>
                        <input type="text" class="form-control" id="country_updated_at" name="country_updated_at"
                            placeholder="Enter country name" readonly>
                    </div>
                    {{-- <div class="form-group">
                        <label for="name">Updated from</label>
                        <input type="text" class="form-control" id="country_updated_from" name="country_updated_from"
                            placeholder="Enter country name" readonly>
                    </div> --}}

                    <div class="form-group">
                        <!-- select -->
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="country_active"
                                    name="country_active" readonly>
                                <label for="active" class="custom-control-label">{{ __('Active ?!') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('super-scripts')
    <script>
        function confirmDestroy(id, refrance) {
            Swal.fire({
                title: '{{ __('Are you sure?') }}',
                text: "{{ __('You won\'t be able to revert this!') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonText: '{{ __('Cancel') }}',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('Yes, delete it!') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    destoy(id, refrance);
                }
            });
        }

        function destoy(id, refrance) {
            // static-countries/{id}
            axios.delete('/cheek-system/static-countries/' + id)
                .then(function(response) {
                    // handle success
                    console.log(response);
                    refrance.closest('tr').remove();
                    showDeletingMessage(response.data);
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                    showDeletingMessage(error.response.data);
                })
                .then(function() {
                    // always executed
                });
        }

        function showDeletingMessage(data) {
            Swal.fire({
                icon: data.icon,
                title: data.title,
                text: data.text,
                showConfirmButton: false,
                timer: 2000
            });
        }

        function country_show(id, url) {
            // static-country-view/{id}
            console.log(url);
            axios.get('/cheek-system/static-country-view/' + id)
                .then(function(response) {
                    // handle success
                    // console.log(response.data.country.active);
                    document.getElementById('country_name').value = response.data.country.name;
                    if (response.data.country.active) {
                        document.getElementById('country_active').checked = true;
                    } else {
                        document.getElementById('country_active').checked = false;
                    }
                    document.getElementById('country_edit_link').href = url;
                    document.getElementById('country_created_at').value = response.data.country.created_at;
                    document.getElementById('country_updated_at').value = response.data.country.updated_at;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                })
                .then(function() {
                    // always executed
                });
        }

        function countries_report() {
            // static-country-view/{id}
            axios.get('/cheek-system/reports/countries-report')
                .then(function(response) {
                    // handle success
                    // console.log(response);
                })
                .catch(function(error) {
                    // console.log(error);
                })
                .then(function() {
                    // always executed
                });
        }
    </script>
@endsection
