@extends('back-end.supers.dashboard')

@section('super-title', __('Super Users'))
@section('super-location', __('Dashboard'))
@section('super-index', __('Super Users'))


@section('super-styles')
    @livewireStyles
@endsection

@section('super-content')
    <div class="container-fluid">

        @if (session('message'))
            <div class="alert @if (@session('code') == 200) alert-success @else alert-danger @endif alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i>
                    @if (session('code') == 200)
                        {{ __('Success!') }}
                    @else
                        {{ __('Failed!') }}
                    @endif
                </h5>
                {{ session('message') }}.
            </div>
        @endif

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
                @livewire('create-user-with-constraints-for-modal')
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
            axios.delete('/cheek-system/admins/' + id)
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
