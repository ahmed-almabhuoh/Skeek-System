<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ __('cms.add_skeed') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="create-form">
                <div class="card-body">
                    <div class="form-group">
                        <label for="beneficiary_name">{{ __('cms.beneficiary_name') }}</label>
                        <input type="text" class="form-control" id="beneficiary_name" wire:model="beneficiary_name"
                            placeholder="Enter Beneficiary Name" value="{{ old('beneficiary_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="amount">{{ __('cms.amount') }}</label>
                        <input type="number" class="form-control" id="amount" placeholder="Enter amount number"
                            wire:model="amount" value="{{ old('amount') }}">
                    </div>
                    <div class="form-group">
                        <label>Currancy</label>
                        <select class="form-control" id="currancy" wire:model="currany">
                            <option @if (old('currancy') == 'Dinar') selected @endif>{{ __('cms.dinar') }}
                            </option>
                            <option @if (old('currancy') == 'Dollar') selected @endif>{{ __('cms.dollar') }}
                            </option>
                            <option @if (old('currancy') == 'shakel') selected @endif>{{ __('cms.shakel') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Country</label>
                        <select class="form-control" wire:model="country_id" id="country_id">
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                            {{-- <option value="German">Gereman</option> --}}
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ __('cms.bank') }}</label>
                        <select class="form-control" id="bank_id" wire:model="bank">
                            @foreach ($banks as $selected_bank)
                                <option value="{{ $selected_bank->id }}">{{ $selected_bank->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="desc">{{ __('cms.desc') }}</label>
                        <input type="text" class="form-control" id="desc" placeholder="Enter description"
                            value="{{ old('desc') }}" wire:model="desc">
                    </div>
                    <label>{{ __('cms.type') }}</label>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="paid" checked="">
                            <label class="form-check-label">{{ __('cms.paid') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="recived" name="status">
                            <label class="form-check-label">{{ __('cms.recived') }}</label>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="button" onclick="store()" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    <!--/.col (left) -->
    <div class="col-md-6">
        <!-- Form Element sizes -->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">{{ __('cms.your_sheek') }}</h3>
            </div>
            <div class="card-body" style="background-image: url({{Storage::url($image_name)}})">
                <img src="{{ Storage::url($image_name) }}" alt="Sheek Image" style="display: inline;">
                <h3>Sheek</h3>
                Beneficiary Name: {{ $beneficiary_name }} <br>
                Amount: {{ $amount }} <br>
                Currancy: {{ $currany }} <br>
                {{-- Bank: {{ $bank->name }} <br> --}}
                Description: {{ $desc }} <br>
                Country: {{ $country_id }} <br>
                Back: {{ $bank }} <br>
                {{-- Image: {{ dd($image_name->img) }} <br> --}}
                Image name: {{ $image_name }} <br>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
