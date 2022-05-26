@extends('back-end.index')

@section('title', __('cms.edit_sheek'))
@section('location', __('cms.edit_sheek'))
@section('index', __('cms.edit'))

@section('styles')
    <style>
        .sheek-background {
            position: relative;
        }

        .name {
            position: absolute;
            top: 37%;
            left: 40%;
            transform: translate(-50%, -50%);
            font-size: 22px;
            font-weight: bold;
        }

        .amount-in-numbers {
            position: absolute;
            top: 44%;
            right: 9%;
            transform: translate(-50%, -50%);
            font-size: 24px;
        }

        .amount-in-letter {
            position: absolute;
            top: 45%;
            left: 40%;
            transform: translate(-50%, -50%);
            font-size: 22px;
            font-weight: bold;
        }

        .date {
            position: absolute;
            top: 58%;
            right: 25%;
            transform: translate(-50%, -50%);
            font-size: 24px;
        }

        .sheek-background img {
            width: 100%;
            height: auto;
            border: 1px solid #000;
            /* opacity: 0.3; */
        }
    </style>
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
                    date: document.getElementById('date').value,
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
