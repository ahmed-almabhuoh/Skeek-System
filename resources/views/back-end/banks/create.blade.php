@extends('back-end.index')

@section('title', __('cms.add_bank'))
@section('location', __('cms.add_bank'))
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
                            <h3 class="card-title">{{ __('cms.add_bank') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create-form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{ __('cms.name') }}</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter bank name">
                                </div>
                                <div class="form-group">
                                    <label for="city">{{ __('cms.city') }}</label>
                                    <input type="text" class="form-control" id="city" placeholder="Enter city">
                                </div>
                                <div class="form-group">
                                    <label>{{ __('cms.country') }}</label>
                                    <select class="form-control" id="country_id">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sheek_image">{{ __('cms.image') }}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="sheek_image">
                                            <label class="custom-file-label"
                                                for="sheek_image">{{ __('cms.select_sheek_image') }}</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">{{ __('cms.upload') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="active" checked>
                                    <label class="form-check-label" for="active">{{ __('cms.active') }}</label>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="applyStoreBank()"
                                    class="btn btn-primary">{{ __('cms.create') }}</button>
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
    <script src="{{ asset('sheekSystem/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script>
        function applyStoreBank() {
            // check-system/countries
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('city', document.getElementById('city').value);
            formData.append('country_id', document.getElementById('country_id').value);
            formData.append('sheek_image', document.getElementById('sheek_image').files[0]);
            formData.append('active', document.getElementById('active').checked ? 1 : 0);
            axios.post('/check-system/banks', formData)
                .then(function(response) {
                    // handle success
                    console.log(response);
                    toastr.success(response.data.message);
                    document.getElementById('create-form').reset();
                    window.location.href = '/check-system/banks';
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
