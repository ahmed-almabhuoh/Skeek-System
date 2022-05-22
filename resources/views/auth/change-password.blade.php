@extends('back-end.index')

@section('title', __('cms.change_password'))
@section('location', __('cms.change_password'))
@section('index', __('cms.edit'))

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('cms.change_password') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="change-form">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="beneficiary_name">{{ __('cms.current_password') }}</label>
                                <input type="password" class="form-control" placeholder="Enter current password"
                                    id="current_password">
                            </div>

                            <div class="form-group">
                                <label for="beneficiary_name">{{ __('cms.new_password') }}</label>
                                <input type="password" class="form-control" placeholder="Enter new password"
                                    id="password">
                            </div>

                            <div class="form-group">
                                <label for="beneficiary_name">{{ __('cms.new_password_confirmation') }}</label>
                                <input type="password" class="form-control" placeholder="Enter new password confirmation"
                                    id="password_confirmation">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="applyChangePassword()"
                                class="btn btn-primary">{{ __('cms.change') }}</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.row -->
        </div><!-- /.containers-fluid -->
    </section>
@endsection



@section('scripts')
    <script>
        function applyChangePassword() {
            // check-system/sheeks
            axios.post('/check-system/change-password', {
                    current_password: document.getElementById('current_password').value,
                    password: document.getElementById('password').value,
                    password_confirmation: document.getElementById('password_confirmation').value,
                })
                .then(function(response) {
                    // handle success
                    console.log(response);
                    toastr.success(response.data.message);
                    document.getElementById('change-form').reset();
                    // window.location.href = '/check-system/sheeks';
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
