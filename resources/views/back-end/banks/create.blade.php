@extends('back-end.index')

@section('title', __('cms.add_bank'))
@section('location', __('cms.add_bank'))
@section('index', __('cms.add'))

@section('styles')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    @livewireStyles
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

                        @if ($errors->any())
                            <div style="margin: 15px">

                                @if (!session()->get('created'))
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-ban"></i> {{ session()->get('title') }}!</h5>
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                            </div>
                        @endif
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create-form" method="POST" action="{{ route('banks.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{ __('cms.name') }}</label>
                                    @error('name')
                                        <p class="text-danger" style="display: inline-block; padding: 0 0 0 10px;">
                                            {{ $message }}</p>
                                    @enderror
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Enter bank name">
                                </div>
                                <div class="form-group">
                                    <label for="city">{{ __('cms.city') }}</label>
                                    @error('city')
                                        <p class="text-danger" style="display: inline-block; padding: 0 0 0 10px;">
                                            {{ $message }}</p>
                                    @enderror
                                    <input type="text" class="form-control" id="city" name="city"
                                        placeholder="Enter city">
                                </div>
                                <div class="form-group">
                                    <label>{{ __('cms.country') }}</label>
                                    @error('country_id')
                                        <p class="text-danger" style="display: inline-block; padding: 0 0 0 10px;">
                                            {{ $message }}</p>
                                    @enderror
                                    <select class="form-control" id="country_id" name="country_id">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <livewire:option-sheek-image />

                                <div class="form-check">
                                    @error('active')
                                        <p class="text-danger" style="display: inline-block; padding: 0 0 0 10px;">
                                            {{ $message }}</p>
                                    @enderror
                                    <input type="checkbox" class="form-check-input" id="active" checked>
                                    <label class="form-check-label" for="active">{{ __('cms.active') }}</label>
                                </div>


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                {{-- <button type="button" onclick="applyStoreBank()"
                                    class="btn btn-primary">{{ __('cms.create') }}</button> --}}
                                <input type="submit" value="Create" class="btn btn-primary">
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

    @livewireScripts
@endsection
