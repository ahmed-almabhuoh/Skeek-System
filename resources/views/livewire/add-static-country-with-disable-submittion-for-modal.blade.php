<form action="{{ route('countries.static_store') }}" method="POST">
    @csrf
    <div class="modal-body">
        <p>{{ __('After you add this static country with active status, it\'ll be usable for all users in systems') }}&hellip;
        </p>
        <div class="form-group">

            <label for="name"
                @error('name')
                style="color: red;"
            @enderror>{{ __('Country name') }}</label>
            <input type="text" class="form-control" id="name" name="name" wire:model="static_country_name"
                @error('name')
                    style="border-color: red" 
                    @enderror
                placeholder="{{ __('Enter country name') }}" value="{{ old('name') }}">
            <small>{{ __('The country name should have at least three letters') }}</small>

            @error('name')
                <small style="color:red">{{ $message }}</small>
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
        if (empty($static_country_name)) {
            echo 'disabled';
        } elseif (strlen($static_country_name) <= 2) {
            echo 'disabled';
        }
        ?>>{{ __('Insert') }}</button>
    </div>
</form>
