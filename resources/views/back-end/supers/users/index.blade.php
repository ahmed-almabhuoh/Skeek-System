@extends('back-end.supers.dashboard')

@section('super-title', 'Super Users')
@section('super-location', 'Dashboard')
@section('super-index', 'Super Users')


@section('super-styles')
@endsection

@section('super-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Users</h3>

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
                                    <th>E-mail</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Status</th>
                                    @canany(['Ban-User', 'Follow-Up-User', 'Delete-User'])
                                        <th>Settings</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->id }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->created_at->diffForHumans() }}</td>
                                        <td>{{ $admin->updated_at->diffForHumans() }}</td>
                                        <td><span
                                                class="tag tag-success">{{ $admin->active ? 'Un-Banned' : 'Banned' }}</span>
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
            // check-system/banks/{bank}
            axios.delete('/cheek-system/delete-user/' + id)
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
