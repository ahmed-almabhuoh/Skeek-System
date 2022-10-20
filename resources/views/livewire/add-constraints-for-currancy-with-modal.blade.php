<form action="{{ route('currancies.store') }}" method="POST">
    @csrf
    <div class="modal-body">
        <p>{{ __('After you add this currancy with active status, it\'ll be usable for all users in system') }}&hellip;
        </p>
        <div class="form-group">

            <label for="name">{{ __('Currancy name') }}</label>
            <input type="text" class="form-control @error('name')
                is-invalid
            @enderror"
                id="name" name="name" wire:model="name" placeholder="{{ __('Enter currancy name') }}"
                value="{{ old('name') }}">
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
        if (strlen($name) <= 1) {
            echo 'disabled';
        }
        ?>>{{ __('Insert') }}</button>
    </div>
</form>
