@extends('back-end.index')

@section('title', __('cms.add_countries'))
@section('location', __('cms.add_countries'))
@section('index', __('cms.add'))

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="callout callout-info">
                        <h5>We are the work team, we have added some countries & its banks for you to save you time and
                            effort!</h5>
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Our support countries & banks</h3>
                                    </div>
                                    <!-- ./card-header -->
                                    <div class="card-body p-0">
                                        <table class="table table-hover">
                                            <tbody>
                                                @foreach ($static_countries as $static_country)
                                                    <tr data-widget="expandable-table" aria-expanded="false">
                                                        <td>
                                                            <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                                            {{ $static_country->name }}
                                                        </td>
                                                    </tr>
                                                    <tr class="expandable-body d-none">
                                                        <td>
                                                            <div class="p-0" style="">
                                                                <table class="table table-hover">
                                                                    <tbody>
                                                                        @foreach ($static_banks as $static_bank)
                                                                            @if ($static_bank->country_id == $static_country->id)
                                                                                <tr>
                                                                                    <td>{{ $static_bank->name }}</td>
                                                                                    <td>
                                                                                        @foreach ($currancies as $currancy)
                                                                                            @if ($static_bank->currancy_id == $currancy->id)
                                                                                                {{ $currancy->name }}
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </td>
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
                        {{-- <ul>
                            @foreach ($static_countries as $static_country)
                                <li>
                                    <strong>{{ $static_country->name }}</strong>
                                    <ul>
                                        @foreach ($static_banks as $static_bank)
                                            @if ($static_bank->country_id == $static_country->id)
                                                <li>
                                                    {{ $static_bank->name }}
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul> --}}
                        <p>This does not prevent you from creating the countries & banks you want to deal with.</p>
                    </div>
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('cms.add_countries') }}</h3>
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
                        <form method="POST" action="{{ route('countries.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{ __('cms.name') }}</label>
                                    @error('name')
                                        <p class="text-danger" style="display: inline-block; padding: 0 0 0 10px;">
                                            {{ $message }}</p>
                                    @enderror
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter country name" value="{{ old('name') }}">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="active" name="active" checked>
                                    <label class="form-check-label" for="active">{{ __('cms.active') }}</label>
                                    @error('active')
                                        <p class="text-danger" style="display: inline-block; padding: 0 0 0 10px;">
                                            {{ $message }}</p>
                                    @enderror
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

@section('scripts')

@endsection
