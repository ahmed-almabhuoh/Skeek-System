<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Sheek System') }} | {{ __('Verify Email') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('sheekSystem/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('sheekSystem/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('sheekSystem/dist/css/adminlte.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('sheekSystem/plugins/toastr/toastr.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="sheekSystem/index2.html" class="h1"><b>{{ __('Sheek') }}</b>{{ __('System') }}</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">
                    {{ __('You are only one step a way from email verification, verify your email now.') }}</p>
                <form>
                    <div class="row">
                        <div class="col-12">
                            <button type="button" onclick="applySendEmailVerification()"
                                class="btn btn-primary btn-block">Send Email Verification</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('sheekSystem/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('sheekSystem/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('sheekSystem/dist/js/adminlte.min.js') }}"></script>
    {{-- SWEET ALERT --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- AXIOS LIBRARY --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Toastr -->
    <script src="{{ asset('sheekSystem/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        function applySendEmailVerification() {
            axios.get('/check-system/verify-email/send')
                .then(function(response) {
                    // handle success
                    console.log(response);
                    toastr.success(response.data.message);
                    window.location.href = '/check-system/dashboard';
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                    toastr.error(error.response.data.message);
                    // window.location.href = '/sheekSystem/admin';
                })
                .then(function() {
                    // always executed
                });
        }
    </script>
</body>

</html>
