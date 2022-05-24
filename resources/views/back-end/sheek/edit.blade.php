@extends('back-end.index')

@section('title', __('cms.edit_sheek'))
@section('location', __('cms.edit_sheek'))
@section('index', __('cms.edit'))

@section('styles')

    @livewireStyles
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            @livewire('edit-sheek', [
            'sheek' => $sheek,
            ])
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection



@section('scripts')
    <script>
        function update(id) {
            // check-system/sheeks
            axios.put('/check-system/sheeks/' + id, {
                beneficiary_name: document.getElementById('beneficiary_name').value,
                amount: document.getElementById('amount').value,
                currancy: document.getElementById('currancy').value,
                bank_id: document.getElementById('bank_id').value,
                desc: document.getElementById('desc').value,
                type: document.getElementById('recived').checked ? 'recived' : 'paid',
                underline_type: document.getElementById('underline_type').value,
            })
                .then(function(response) {
                    // handle success
                    console.log(response);
                    toastr.success(response.data.message);
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
