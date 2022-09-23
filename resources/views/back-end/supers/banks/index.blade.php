@extends('back-end.supers.dashboard')

@section('super-title', __('Static banks'))
@section('super-location', __('Dashboard'))
@section('super-index', __('Static banks'))


@section('super-styles')

@endsection

@section('super-content')
    <div class="container-fluid">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            {{__('New Bank')}}
        </button>
        <a href="{{ route('report.banks') }}" class="btn btn-default">
            {{__('')}}
        </a>
        <div style="margin: 10px"></div>
        @if (session()->get('created'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> {{ session()->get('title') }}!</h5>
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('All static banks')}}</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Image')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Country')}}</th>
                                    <th>{{__('City')}}</th>
                                    <th>{{__('Currancy')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Created at')}}</th>
                                    <th>{{__('Updated at')}}</th>
                                    @canany(['Update-Bank', 'Delete-Bank'])
                                        <th>{{__('Settings')}}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @if (!count($banks))
                                    <td colspan="10">
                                        <center>{{__('No data found ... ')}}</center>
                                    </td>
                                @endif
                                @foreach ($banks as $bank)
                                    <tr>
                                        <td>{{ $bank->id }}</td>
                                        <td>
                                            @php
                                                $img = $bank->img;
                                            @endphp
                                            @if (!is_null($img))
                                                <img src="{{ Storage::url('public/img/' . $bank->img) }}" width="40px"
                                                    height="40px" alt="No image">
                                            @else
                                                {{__('No image')}}
                                            @endif
                                        </td>
                                        <td>{{ $bank->name }}</td>
                                        <td>
                                            @foreach ($countries as $country)
                                                @if ($country->id == $bank->country_id)
                                                    {{ $country->name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $bank->city }}</td>
                                        <td>
                                            @foreach ($currancies as $currancy)
                                                @if ($currancy->id == $bank->currancy_id)
                                                    {{ $currancy->name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $bank->created_at }}</td>
                                        <td>{{ $bank->updated_at }}</td>
                                        <td><span
                                                class="badge @if (!$bank->active) bg-danger @else bg-success @endif">
                                                @if ($bank->active)
                                                    {{__('Active')}}
                                                @else
                                                    {{__('In-active')}}
                                                @endif
                                            </span>
                                        </td>
                                        @canany(['Update-Bank', 'Delete-Bank'])
                                            <td>
                                                <div class="btn-group">
                                                    @can('Update-Bank')
                                                        <a href="{{ route('banks.static_edit', Crypt::encrypt($bank->id)) }}"
                                                            class="btn btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endcan

                                                    @can('Delete-Bank')
                                                        <button type="button"
                                                            onclick="confirmDestroy('{{ Crypt::encrypt($bank->id) }}', this)"
                                                            class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    @endcan

                                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                                        data-target="#bank-view-modal"
                                                        onclick="bank_show('{{ Crypt::encrypt($bank->id) }}', '{{ Storage::url('public/img/') }}', '{{ route('banks.static_update', Crypt::encrypt($bank->id)) }}')">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div>

    <div class="modal fade" id="bank-view-modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('Static Bank Details')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{__('This is a static bank is')}} <strong>{{__('usable')}}</strong> {{__('for all users in the system with')}}
                        <strong>{{__('active status')}}</strong>
                        <br> {{__('If you need to change its settings')}} <a id="bank_edit_link" href="">{{__('Go to its edit view')}}</a>&hellip;
                    </p>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bank_name">{{__('Bank name')}}</label>
                                    <input type="text" class="form-control" id="bank_name" name="bank_name"
                                        placeholder="Enter Bank name" value="" readonly>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="country">{{__('Country')}}</label>
                                    <input type="text" class="form-control" id="bank_country" name="country"
                                        placeholder="Enter Bank country" value="" readonly>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="Currancy">{{__('Currancy')}}</label>
                                    <input type="text" class="form-control" id="bank_currancy" name="Currancy"
                                        placeholder="Enter Bank Currancy" value="" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="City">{{__('City')}}</label>
                                    <input type="text" class="form-control" id="bank_city" name="City"
                                        placeholder="Enter Bank City" value="" readonly>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="created_at">{{__('Created at')}}</label>
                                    <input type="text" class="form-control" id="bank_created_at" name="created_at"
                                        placeholder="Enter Bank created_at" value="" readonly>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="updated_at">{{__('Updated at')}}</label>
                                    <input type="text" class="form-control" id="bank_updated_at" name="updated_at"
                                        placeholder="Enter Bank updated_at" value="" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="row">
                            <div class="form-group d-flex jsutify-content-center">
                                <label for="City">{{__('Sheek Image')}}</label><br>
                                <img src="" alt="Sheek image" id="bank_image">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>




    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('Add new static bank')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('banks.static_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <p>{{__('After you add this static bank with')}} <strong>{{__('active status')}}</strong>{{__(', it\'ll be')}}
                            <strong>{{__('usable')}}</strong> {{__('for all users in systems')}}&hellip;
                        </p>
                        <div class="form-group">

                            <label>{{__('Bank name')}}</label>
                            <input type="text" class="form-control" id="name" name="name"
                                @error('name')
                                    style="border-color: red" 
                                    @enderror
                                placeholder="Enter Bank name" value="{{ old('name') }}">
                            @error('name')
                                <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{__('For country')}}</label>
                            <select class="form-control" name="country_id" id="country_id"
                                @error('country_id')
                                style="border-color: red;"
                            @enderror>
                                <option value="0">*</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <small style="color: red"> {{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{__('With currancy')}}</label>
                            <select class="form-control" name="currancy_id" id="currancy_id"
                                @error('currancy_id')
                                style="border-color: red"
                            @enderror>
                                <option value="0">*</option>
                                @foreach ($currancies as $currancy)
                                    <option value="{{ $currancy->id }}">{{ $currancy->name }}</option>
                                @endforeach
                            </select>
                            @error('currancy_id')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">

                            <label for="city"
                                @error('city')
                                style="color: red;"
                            @enderror>
                                {{__('In City')}}
                            </label>
                            <input type="text" class="form-control" id="city" name="city"
                                @error('city')
                                    style="border-color: red" 
                                    @enderror
                                placeholder="Enter Bank city" value="{{ old('city') }}">
                            @error('city')
                                <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">{{__('Upload your sheek image')}}</label>
                            <div class="input-group">
                                <div class="custom-file">

                                    <input type="file" class="custom-file-input" name="image" id="image">
                                    <label class="custom-file-label" for="image">{{__('Choose image')}}</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">{{__('Upload')}}</span>
                                </div>
                            </div>
                            @error('image')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <!-- select -->
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="active" name="active">
                                    <label for="active" class="custom-control-label">{{__('Active ?!')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">

                        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Insert')}}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('super-scripts')
    <script>
        function confirmDestroy(id, refrance) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    destoy(id, refrance);
                }
            });
        }

        function destoy(id, refrance) {
            // static-banks/{id}
            axios.delete('/cheek-system/static-banks/' + id)
                .then(function(response) {
                    // handle success
                    console.log(response);
                    refrance.closest('tr').remove();
                    showDeletingMessage(response.data);
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                    showDeletingMessage(error.response.data);
                })
                .then(function() {
                    // always executed
                });
        }

        function showDeletingMessage(data) {
            Swal.fire({
                icon: data.icon,
                title: data.title,
                text: data.text,
                showConfirmButton: false,
                timer: 2000
            });
        }


        function bank_show(id, local_storage_url, url) {
            // static-country-view/{id}
            axios.get('/cheek-system/static-bank-view/' + id)
                .then(function(response) {
                    // handle success
                    console.log(response);

                    document.getElementById('bank_edit_link').href = url;
                    document.getElementById('bank_name').value = response.data.bank.name;
                    document.getElementById('bank_country').value = response.data.country.name;
                    document.getElementById('bank_currancy').value = response.data.currancy.name;
                    document.getElementById('bank_city').value = response.data.bank.city;
                    document.getElementById('bank_created_at').value = response.data.bank.created_at;
                    document.getElementById('bank_updated_at').value = response.data.bank.updated_at;
                    image_path = local_storage_url + response.data.bank.img;
                    console.log(image_path);
                    document.getElementById('bank_image').src = image_path;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                })
                .then(function() {
                    // always executed
                });
        }
    </script>
@endsection
