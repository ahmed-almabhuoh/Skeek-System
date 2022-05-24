@extends('back-end.index')

@section('title', __('cms.edit_countries'))
@section('location', __('cms.edit_countries'))
@section('index', __('cms.edit'))

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
                            <h3 class="card-title">{{ __('cms.edit_countries') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="update-form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{ __('cms.name') }}</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter country name" value="{{$country->name}}">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="active" @if ($country->active)
                                        checked
                                    @endif>
                                    <label class="form-check-label" for="active">{{ __('cms.active') }}</label>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="applyEditingCountry()" class="btn btn-primary">{{ __('cms.edit') }}</button>
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
        function applyEditingCountry() {
            // check-system/countries
            axios.put('/check-system/countries/{{$country->id}}', {
                name: document.getElementById('name').value,
                active: document.getElementById('active').checked,
            })
                .then(function(response) {
                    // handle success
                    console.log(response);
                    toastr.success(response.data.message);
                    document.getElementById('update-form').reset();
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
