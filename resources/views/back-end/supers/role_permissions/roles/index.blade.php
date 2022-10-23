@extends('back-end.supers.dashboard')

@section('super-title', __('Roles'))
@section('super-location', __('Dashboard'))
@section('super-index', __('Roles'))

@section('super-styles')
    @livewireStyles
@endsection


@section('super-content')
    <div class="container-fluid">
        <div class="row">
            @if (session('code') == 200)
                <div class="card-body">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> {{ __('Success!') }}</h5>
                        {{ session('status') }}
                    </div>
                </div>
            @elseif (session('code') == 500)
                <div class="card-body">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> {{ __('Failed!') }}</h5>
                        {{ session('status') }}
                    </div>
                </div>
            @endif
            @livewire('role-search', [
                'roles' => $roles,
            ])
        </div>
        <!-- /.row -->
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
            axios.delete('/cheek-system/roles/' + id)
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
