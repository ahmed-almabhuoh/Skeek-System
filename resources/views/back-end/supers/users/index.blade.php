@extends('back-end.supers.dashboard')

@section('super-title', 'Super Users')
@section('super-location', 'Dashboard')
@section('super-index', 'Super Users')


@section('super-styles')
@endsection

@section('super-content')
    <div class="container-fluid">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            New User
        </button>

        <button type="button" class="btn btn-default">
            Export user report
        </button>
        <div style="margin: 10px;"></div>
        <div class="row">
            <div class="card-body">
                @if (session('code') == 200)
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                        {{ session('status') }}.
                    </div>
                @elseif(session('code') == 500)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Alert!</h5>
                        {{ session('status') }}.
                    </div>
                @endif
            </div>
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

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add new user</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('super.user_store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        {{-- <p>After you add this static country with <strong>active status</strong>, it'll be
                            <strong>usable</strong> for all users in systems&hellip;
                        </p> --}}
                        <div class="form-group">

                            <label for="name"
                                @error('name')
                                style="color: red;"
                            @enderror>User
                                name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                @error('name')
                                    style="border-color: red" 
                                    @enderror
                                placeholder="Enter country name" value="{{ old('name') }}">
                            @error('name')
                                <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">

                            <label for="email"
                                @error('email')
                                style="color: red;"
                            @enderror>User
                                email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                @error('email')
                                    style="border-color: red" 
                                    @enderror
                                placeholder="Enter super mail" value="{{ old('email') }}">
                            @error('email')
                                <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">

                            <label for="password"
                                @error('password')
                                style="color: red;"
                            @enderror>User
                                password</label>
                            <input type="text" class="form-control" id="password" name="password"
                                @error('password')
                                    style="border-color: red" 
                                    @enderror
                                placeholder="Enter super password" value="{{ $password }}">
                            @error('password')
                                <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <!-- select -->
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="active" name="active">
                                    <label for="active" class="custom-control-label">Active ?!</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Insert</button>
                    </div>
                </form>
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
