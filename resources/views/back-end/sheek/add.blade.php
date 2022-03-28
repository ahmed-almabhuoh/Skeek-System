@extends('back-end.index')

@section('title', __('cms.add_skeed'))
@section('location', __('cms.add_skeed'))
@section('index', __('cms.add'))

@section('styles')

    @livewireStyles
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            @livewire('sheek')
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection



@section('scripts')
    <script>
        function store() {
            // check-system/sheeks
            let formData = new FormData();
            formData.append('beneficiary_name', document.getElementById('beneficiary_name').value);
            formData.append('amount', document.getElementById('amount').value);
            formData.append('currancy', document.getElementById('currancy').value);
            formData.append('bank', document.getElementById('bank_name').value);
            formData.append('desc', document.getElementById('desc').value);
            formData.append('status', document.getElementById('recived').checked ? 'recived' : 'paid');
            axios.post('/check-system/sheeks', formData)
                .then(function(response) {
                    // handle success
                    console.log(response);
                    toastr.success(response.data.message);
                    // document.getElementById('set-form').reset();
                    document.getElementById('reset-form').reset();
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
    @livewireScripts
@endsection
