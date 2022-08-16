@extends('back-end.supers.dashboard')

@section('super-title', 'Static Countries')
@section('super-location', 'Dashboard')
@section('super-index', 'Static Countries')


@section('super-styles')

@endsection

@section('super-content')
    <div class="container-fluid">
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
                        <h3 class="card-title">All static countries</h3>

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
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    @canany(['Update-Country', 'Delete-Country'])
                                        <th>Settings</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countries as $country)
                                    <tr>
                                        <td>{{ $country->id }}</td>
                                        <td>{{ $country->name }}</td>
                                        <td>{{ $country->created_at }}</td>
                                        <td>{{ $country->updated_at }}</td>
                                        <td><span
                                                class="badge @if (!$country->active) bg-danger @else bg-success @endif">
                                                @if ($country->active)
                                                    Active
                                                @else
                                                    In-active
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
                                                        <button type="button" onclick="confirmDestroy({{ $country->id }}, this)"
                                                            class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
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
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('super-scripts')
    <script>
        function confirmDestroy(id, refrance) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
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
    </script>
@endsection
