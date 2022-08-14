@extends('back-end.supers.dashboard')

@section('super-title', 'permission Permission')
@section('super-location', 'Dashboard')
@section('super-index', 'permission Permission')

@section('super-styles')
    <link rel="stylesheet" href="{{ asset('sheekSystem/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection


@section('super-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Assign permissions to a specific <strong>{{ $role->name }}</strong>
                            role.
                        </h3>

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
                                    <th>Permission Name</th>
                                    <th>For Role</th>
                                    <th>Guard Name</th>
                                    <th>Assign</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            {{ $role->name . '-' . $role->id }}
                                        </td>
                                        <td>{{ $permission->guard_name }}</td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="permission_{{ $permission->id }}"
                                                    onchange="assignPermissionToRole('{{ $permission->id }}')"
                                                    @if ($permission->assigned) checked @endif>
                                                <label for="permission_{{ $permission->id }}">
                                                </label>
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
        function assignPermissionToRole(permission_id) {
            // check-system/countries
            axios.post('/cheek-system/role-permission/' + permission_id, {
                    role_id: {{ $role->id }},
                })
                .then(function(response) {
                    // handle success
                    console.log(response);
                    toastr.success(response.data.message);
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                    toastr.error(error.response.data.message)
                })
                .then(function() {
                    // always executed
                });
        }
    </script>
@endsection
