<form id="create-form" method="POST" action="{{ route('banks.static_store') }}" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name"
                class="form-control @error('name')
                is-invalid
            @enderror" id="name"
                wire:model="bank_name" placeholder="{{ __('Enter bank name') }}" value="{{ old('name') }}">
            @error('name')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('Country') }}</label>
            <select class="form-control @error('country_id')
            is-invalid
        @enderror" id="country_id"
                name="country_id" wire:model="country_id">
                <option value="0">*</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
            @error('country_id')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('Currancy') }}</label>
            <select class="form-control @error('currancy_id')
            is-invalid
        @enderror" id="currancy_id"
                name="currancy_id" wire:model="currancy_id">
                <option value="0">*</option>
                @foreach ($currancies as $currancy)
                    <option value="{{ $currancy->id }}">{{ $currancy->name }}</option>
                @endforeach
            </select>
            @error('currancy_id')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="city">{{ __('City') }}</label>
            <input type="text" class="form-control @error('city')
            is-invalid
        @enderror"
                id="city" name="city" wire:model="city" placeholder="{{ __('Enter city name') }}"
                value="{{ old('city') }}">
            @error('city')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="exampleInputFile">{{ __('Choose sheek image') }}</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file"
                        class="custom-file-input @error('image')
                    is-invalid
                @enderror"
                        name="image" id="image">
                    @error('image')
                        <small style="color: red;">{{ $message }}</small>
                    @enderror
                    <label class="custom-file-label" for="image">{{ __('Choose image') }}</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text">{{ __('Upload') }}</span>
                </div>
            </div>
        </div>

        <!-- Livewire Component wire-end:W8rBrt6UaZnBPLgsFBGB -->
        <div class="form-check">
            @error('active')
                <span style="margin-left: 15px;diplay: block; color: red;">
                    {{ $message }}
                </span>
            @enderror
            <input type="checkbox" class="form-check-input" id="active" name="active" checked="">
            <label class="form-check-label" for="active">{{ __('Active') }}</label>
        </div>


    </div>
    <!-- /.card-body -->

    <div class="card-footer">

        <input type="submit" value="{{ __('Create') }}" class="btn btn-primary"<?php
        if (strlen($bank_name) <= 2 || strlen($city) <= 2 || $country_id == 0 || $currancy_id == 0) {
            echo 'disabled';
        }
        ?>>
    </div>
</form>
