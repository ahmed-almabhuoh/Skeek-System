@extends('back-end.index')

@section('title', __('cms.add_countries'))
@section('location', __('cms.add_countries'))
@section('index', __('cms.add'))

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('cms.add_countries') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create-form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{ __('cms.name') }}</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter country name">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="active" checked>
                                    <label class="form-check-label" for="active">{{ __('cms.active') }}</label>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="applyStoreCountry()" class="btn btn-primary">{{ __('cms.create') }}</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('scripts')
    <script>
        function applyStoreCountry() {
            // check-system/countries
            axios.post('/check-system/countries', {
                name: document.getElementById('name').value,
                active: document.getElementById('active').checked,
            })
                .then(function(response) {
                    // handle success
                    console.log(response);
                    toastr.success(response.data.message);
                    document.getElementById('create-form').reset();
                    window.location.href = '/check-system/countries';
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
