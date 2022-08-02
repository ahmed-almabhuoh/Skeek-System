@extends('back-end.supers.dashboard')

@section('super-title', 'Edit Static Bank')
@section('super-location', 'Static banks')
@section('super-index', 'Edit')


@section('super-styles')

@endsection

@section('super-content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit bank</h3>
                        </div>
                        <div style="margin: 15px">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create-form" method="POST" action="{{ route('banks.static_update', $bank->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    @error('name')
                                        <span style="margin-left: 15px;diplay: block; color: red;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Enter bank name" value="{{ $bank->name }}">
                                </div>

                                <div class="form-group">
                                    <label>Country</label>
                                    @error('country_id')
                                        <span style="margin-left: 15px;diplay: block; color: red;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <select class="form-control" id="country_id" name="country_id">
                                        @foreach ($countries as $country)
                                            @if ($country->id == $bank->country_id)
                                                <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
                                            @else
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Currancy</label>
                                    @error('currancy_id')
                                        <span style="margin-left: 15px;diplay: block; color: red;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <select class="form-control" id="currancy_id" name="currancy_id">
                                        <option value="0">*</option>
                                        @foreach ($currancies as $currancy)
                                            <option value="{{ $currancy->id }}"
                                                @if ($currancy->id == $bank->currancy_id) selected @endif>{{ $currancy->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="city">City</label>
                                    @error('city')
                                        <span style="margin-left: 15px;diplay: block; color: red;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <input type="text" class="form-control" id="city" name="city"
                                        placeholder="Enter city" value="{{ $bank->city }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Choose sheek image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="image">
                                            <label class="custom-file-label" for="image">Choose
                                                image</label>
                                            @error('image')
                                                <span style="margin-left: 15px;diplay: block; color: red;">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <center>
                                        <img src="{{ Storage::url('img/' . $bank->img) }}" alt="Sheek imaeg">
                                    </center>
                                </div>

                                <!-- Livewire Component wire-end:W8rBrt6UaZnBPLgsFBGB -->
                                <div class="form-check">
                                    @error('active')
                                        <span style="margin-left: 15px;diplay: block; color: red;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <input type="checkbox" class="form-check-input" id="active" name="active"
                                        @if ($bank->active) checked @endif>
                                    <label class="form-check-label" for="active">Update</label>
                                </div>


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">

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

@section('super-scripts')

@endsection
