@extends('back-end.supers.dashboard')

@section('super-title', __('Static banks'))
@section('super-location', __('Dashboard'))
@section('super-index', __('Static banks'))


@section('super-styles')

    @livewireStyles
@endsection

@section('super-content')
    <div class="container-fluid">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            {{ __('New Bank') }}
        </button>
        <a href="{{ route('report.banks') }}" class="btn btn-default">
            {{ __('Export banks report') }}
        </a>
        <div style="margin: 10px"></div>
        @if (session()->get('created'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> {{ session()->get('title') }}!</h5>
                {{ session()->get('message') }}
            </div>
        @endif
        @livewire('search-static-bank')
        <!-- /.row -->
    </div>

    <div class="modal fade" id="bank-view-modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Static Bank Details') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('This is a static bank is') }} <strong>{{ __('usable') }}</strong>
                        {{ __('for all users in the system with') }}
                        <strong>{{ __('active status') }}</strong>
                        <br> {{ __('If you need to change its settings') }} <a id="bank_edit_link"
                            href="">{{ __('Go to its edit view') }}</a>&hellip;
                    </p>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bank_name">{{ __('Bank name') }}</label>
                                    <input type="text" class="form-control" id="bank_name" name="bank_name"
                                        placeholder="Enter Bank name" value="" readonly>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="country">{{ __('Country') }}</label>
                                    <input type="text" class="form-control" id="bank_country" name="country"
                                        placeholder="Enter Bank country" value="" readonly>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="Currancy">{{ __('Currancy') }}</label>
                                    <input type="text" class="form-control" id="bank_currancy" name="Currancy"
                                        placeholder="Enter Bank Currancy" value="" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="City">{{ __('City') }}</label>
                                    <input type="text" class="form-control" id="bank_city" name="City"
                                        placeholder="Enter Bank City" value="" readonly>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="created_at">{{ __('Created at') }}</label>
                                    <input type="text" class="form-control" id="bank_created_at" name="created_at"
                                        placeholder="Enter Bank created_at" value="" readonly>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="updated_at">{{ __('Updated at') }}</label>
                                    <input type="text" class="form-control" id="bank_updated_at" name="updated_at"
                                        placeholder="Enter Bank updated_at" value="" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="row">
                            <div class="form-group d-flex jsutify-content-center">
                                <label for="City">{{ __('Sheek Image') }}</label><br>
                                <img src="" alt="Sheek image" id="bank_image">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <button type="button" class="btn btn-default"
                                data-dismiss="modal">{{ __('Close') }}</button>
                        </div>
                        <!-- /.row -->
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
                    <h4 class="modal-title">{{ __('Add new static bank') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @livewire('add-constraints-for-add-bank-with-modal', [
                    'countries' => $countries,
                    'currancies' => $currancies,
                ])
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
                confirmButtonText: "{{ __('Yes, delete it!') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    destoy(id, refrance);
                }
            });
        }

        function destoy(id, refrance) {
            // static-banks/{id}
            axios.delete('/cheek-system/static-banks/' + id)
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


        function bank_show(id, local_storage_url, url) {
            // static-country-view/{id}
            axios.get('/cheek-system/static-bank-view/' + id)
                .then(function(response) {
                    // handle success
                    console.log(response);

                    document.getElementById('bank_edit_link').href = url;
                    document.getElementById('bank_name').value = response.data.bank.name;
                    document.getElementById('bank_country').value = response.data.country.name;
                    document.getElementById('bank_currancy').value = response.data.currancy.name;
                    document.getElementById('bank_city').value = response.data.bank.city;
                    document.getElementById('bank_created_at').value = response.data.bank.created_at;
                    document.getElementById('bank_updated_at').value = response.data.bank.updated_at;
                    image_path = local_storage_url + response.data.bank.img;
                    console.log(image_path);
                    document.getElementById('bank_image').src = image_path;
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
