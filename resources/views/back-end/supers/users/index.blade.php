@extends('back-end.supers.dashboard')

@section('super-title', __('Super Users'))
@section('super-location', __('Dashboard'))
@section('super-index', __('Super Users'))


@section('super-styles')
    @livewireStyles
@endsection

@section('super-content')
    <div class="container-fluid">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            {{ __('New User') }}
        </button>

        <button type="button" class="btn btn-default">
            {{ __('Export user report') }}
        </button>
        <div style="margin: 10px;"></div>
        <div class="row">
            <div class="card-body">
                @if (session('code') == 200)
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> {{ __('Success!') }}</h5>
                        {{ session('status') }}.
                    </div>
                @elseif(session('code') == 500)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> {{ __('Failed!') }}</h5>
                        {{ session('status') }}.
                    </div>
                @endif
            </div>
            @livewire('admin-search-table')

         
            
         
        </div>
        <!-- /.row -->
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Add new user') }}</h4>
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
                            @enderror>{{ __('User name') }}</label>
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
                            @enderror>{{ __('User email') }}</label>
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
                            @enderror>{{ __('User password') }}</label>
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
                confirmButtonText: "{{ __('Yes, delete it!') }}",
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

    @livewireScripts
@endsection
