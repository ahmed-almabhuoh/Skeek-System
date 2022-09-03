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
        </div>
    </section>
@endsection



@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function store() {
            // check-system/sheeks
            let formData = new FormData();
            formData.append('beneficiary_name', document.getElementById('beneficiary_name').value);
            formData.append('amount', document.getElementById('amount').value);
            formData.append('bank_id', document.getElementById('bank_id').value);
            formData.append('desc', document.getElementById('desc').value);
            formData.append('date', document.getElementById('date').value);
            formData.append('type', document.getElementById('recived').checked ? 'recived' : 'paid');
            formData.append('underline_type', document.getElementById('underline_type').value);
            axios.post('/check-system/sheeks', formData)
                .then(function(response) {
                    // handle success
                    console.log(response);
                    toastr.success(response.data.message);
                    document.getElementById('create-form').reset();
                    window.location.href = '/check-system/sheeks';
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
