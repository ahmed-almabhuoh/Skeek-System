@extends('back-end.supers.dashboard')

@section('super-title', __('Currancies'))
@section('super-location', __('Dashboard'))
@section('super-index', __('Currancies'))


@section('super-styles')

    @livewireStyles
@endsection

@section('super-content')
    <div class="container-fluid">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            {{ __('New Currancy') }}
        </button>

        <a href="{{ route('report.currancies') }}" class="btn btn-default">
            {{ __('Export currancy report') }}
        </a>

        <div style="margin: 10px;"></div>

        @if (session()->get('created'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> {{ session()->get('title') }}!</h5>
                {{ session()->get('message') }}
            </div>
        @endif
        @livewire('currancy-search')
        <!-- /.row -->
    </div>

    <div class="modal fade" id="currancy-view-modal">
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
                    <p>{{ __('This is a static currancy is usable for all users in the system with active status') }}
                        <br> {{ __('If you to change its settings') }} <a id="currancy_edit_link"
                            href="">{{ __('Go to its edit view') }}</a>&hellip;
                    </p>
                    <div class="form-group">

                        <label for="name">{{ __('Currancy name') }}</label>
                        <input type="text" class="form-control" id="currancy_name" name="currancy_name"
                            placeholder="Enter currancy name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('Created at') }}</label>
                        <input type="text" class="form-control" id="currancy_created_at" name="currancy_created_at"
                            placeholder="Enter currancy name" readonly>
                    </div>
                    {{-- <div class="form-group">
                        <label for="name">Created from</label>
                        <input type="text" class="form-control" id="country_created_at" name="country_created_from"
                            placeholder="Enter country name" readonly>
                    </div> --}}
                    <div class="form-group">
                        <label for="name">{{ __('Updated at') }}</label>
                        <input type="text" class="form-control" id="currancy_updated_at" name="currancy_updated_at"
                            placeholder="Enter currancy name" readonly>
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
                                <input class="custom-control-input" type="checkbox" id="currancy_active"
                                    name="currancy_active" readonly>
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

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Add new currancy') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @livewire('add-constraints-for-currancy-with-modal')
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
            // static-currancies/{id}
            axios.delete('/cheek-system/currancies/' + id)
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

        function currancy_show(id, url) {
            // cheek-system/currancies/{currancy}
            // console.log(url);
            axios.get('/cheek-system/currancies/' + id)
                .then(function(response) {
                    // console.log(response);
                    // handle success
                    // console.log(response.data.country.active);
                    document.getElementById('currancy_name').value = response.data.currancy.name;
                    if (response.data.currancy.active) {
                        document.getElementById('currancy_active').checked = true;
                    } else {
                        document.getElementById('currancy_active').checked = false;
                    }
                    document.getElementById('currancy_edit_link').href = url;
                    document.getElementById('currancy_created_at').value = response.data.currancy.created_at;
                    document.getElementById('currancy_updated_at').value = response.data.currancy.updated_at;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                })
                .then(function() {
                    // always executed
                });
        }
    </script>

    @livewireScripts
@endsection
