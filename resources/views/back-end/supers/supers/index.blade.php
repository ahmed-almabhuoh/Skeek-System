@extends('back-end.supers.dashboard')

@section('super-title', __('Super Supers'))
@section('super-location', __('Dashboard'))
@section('super-index', __('Super Supers'))


@section('super-styles')
@endsection

@section('super-content')
    <div class="container-fluid">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            {{__('New Super')}}
        </button>

        <button type="button" class="btn btn-default">
            {{__('Export support report')}}
        </button>

        <div class="row">
            <div class="card-body">
                @if (session('code') == 200)
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> {{__('Success!')}}</h5>
                        {{ session('status') }}.
                    </div>
                @elseif(session('code') == 500)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> {{__('Failed!')}}</h5>
                        {{ session('status') }}.
                    </div>
                @endif
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('All Supers')}}</h3>

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
                                    <th>#</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('E-mail')}}</th>
                                    <th>{{__('Created at')}}</th>
                                    <th>{{__('Updated at')}}</th>
                                    <th>{{__('Status')}}</th>
                                    @canany(['Ban-Super', 'Follow-Up-Super', 'Update-Super', 'Delete-Super'])
                                        <th>{{__('Status')}}</th>
                                    @endcanany
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
        </div>
        <!-- /.row -->
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('Add new supor')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('super.super_store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        {{-- <p>After you add this static country with <strong>active status</strong>, it'll be
                            <strong>usable</strong> for all users in systems&hellip;
                        </p> --}}
                        <div class="form-group">

                            <label for="name"
                                @error('name')
                                style="color: red;"
                            @enderror>{{__('Supor fullname')}}</label>
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
                            <label>{{__('With role')}}</label>
                            <select class="form-control" name="role_id" id="role_id"
                                @error('role_id')
                                style="border-color: red;"
                            @enderror>
                                <option value="0">*</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <small style="color: red;">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">

                            <label for="email"
                                @error('email')
                                style="color: red;"
                            @enderror>{{__('Supor email')}}</label>
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
                            @enderror>{{__('Supor password')}}</label>
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
                                    <label for="active" class="custom-control-label">{{__('Active ?!')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">

                        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Inserts')}}</button>
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
            axios.delete('/cheek-system/delete-super/' + id)
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
