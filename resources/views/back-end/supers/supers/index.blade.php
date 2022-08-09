@extends('back-end.supers.dashboard')

@section('super-title', 'Super Supers')
@section('super-location', 'Dashboard')
@section('super-index', 'Super Supers')


@section('super-styles')
@endsection

@section('super-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Supers</h3>

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
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($supers as $super)
                                    <tr>
                                        <td>{{ $super->id }}</td>
                                        <td>{{ $super->name }}</td>
                                        <td>{{ $super->email }}</td>
                                        <td>{{ $super->created_at->diffForHumans() }}</td>
                                        <td>{{ $super->updated_at->diffForHumans() }}</td>
                                        <td><span
                                                class="tag tag-success">{{ $super->active ? 'Un-Banned' : 'Banned' }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" onclick="confirmDestroy('{{ $super->id }}', this)"
                                                    class="btn btn-danger btn-flat">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <a href="{{ route('super.user_ban', $super->id) }}"
                                                    class="btn btn-warning btn-flat">
                                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('super.super_edit', $super->id) }}"
                                                    class="btn btn-primary btn-flat">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('super.user_follow_actions', $super->id) }}"
                                                    class="btn btn-secondary btn-flat">
                                                    <i class="fa fa-location-arrow"></i>
                                                </a>
                                            </div>
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
