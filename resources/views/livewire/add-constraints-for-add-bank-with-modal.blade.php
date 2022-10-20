<form action="{{ route('banks.static_store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <p>{{ __('After you add this static bank with') }}
            <strong>{{ __('active status') }}</strong>{{ __(', it\'ll be') }}
            <strong>{{ __('usable') }}</strong> {{ __('for all users in the system') }}&hellip;
        </p>
        <div class="form-group">


            <label>{{ __('Bank name') }}</label>
            <input type="text" class="form-control" id="name" name="name" wire:model="bank_name"
                @error('name')
                    style="border-color: red" 
                    @enderror
                placeholder="{{ __('Enter Bank name') }}" value="{{ old('name') }}">
            @error('name')
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('For country') }}</label>
            <select class="form-control" name="country_id" id="country_id" wire:model="country_id"
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
            <label>{{ __('With currancy') }}</label>
            <select class="form-control" name="currancy_id" id="currancy_id" wire:model="currancy_id"
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

            <label for="city" @error('city')
                style="color: red;"
            @enderror>
                {{ __('In City') }}
            </label>
            <input type="text" class="form-control" id="city" name="city" wire:model="city"
                @error('city')
                    style="border-color: red" 
                    @enderror
                placeholder="{{ __('Enter Bank city') }}" value="{{ old('city') }}">
            @error('city')
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">{{ __('Upload your sheek image') }}</label>
            <div class="input-group">
                <div class="custom-file">

                    <input type="file" class="custom-file-input" name="image" id="image">
                    <label class="custom-file-label" for="image">{{ __('Choose image') }}</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text">{{ __('Upload') }}</span>
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
                    <label for="active" class="custom-control-label">{{ __('Active ?!') }}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-primary" <?php
        if (strlen($bank_name) <= 2 || strlen($city) <= 2 || $country_id == 0 || $currancy_id == 0) {
            echo 'disabled';
        }
        ?>>{{ __('Insert') }}</button>
    </div>
</form>
