<form action="{{ route('super.user_store') }}" method="POST">
    @csrf
    <div class="modal-body">

        <div class="form-group">

            <label for="name">{{ __('User name') }}</label>
            <input type="text" class="form-control @error('name')
                is-invalid
            @enderror"
                id="name" name="name" wire:model="name" placeholder="{{ __('Enter country name') }}"
                value="{{ old('name') }}">
            @error('name')
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">

            <label for="email">{{ __('User email') }}</label>
            <input type="email"
                class="form-control @error('email')
                is-invalid
            @enderror 
                @if ($emailIsExists) is-invalid @endif
            "
                id="email" name="email" wire:model='email' placeholder="{{ __('Enter user email') }}"
                value="{{ old('email') }}">
            @error('email')
                <small style="color:red">{{ $message }}</small>
            @enderror
            @if ($emailIsExists)
                <small style="color:red">{{ __('Entered email is already exists in our system') }}</small>
            @endif
        </div>

        <div class="form-group">

            <label for="password">{{ __('User password') }}</label>
            <input type="text"
                class="form-control @error('password')
                is-invalid
            @enderror" id="password"
                name="password" placeholder="{{ __('Enter user password') }}" value="{{ $password }}" wire:model="password">
            @error('password')
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <!-- select -->
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="password_generator"
                        name="password_generator" wire:model="userPasswordGenerator">
                    <label for="password_generator"
                        class="custom-control-label">{{ __('Use password generator') }}</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <!-- select -->
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="active" name="active" checked>
                    <label for="active" class="custom-control-label">{{ __('Active ?!') }}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer justify-content-between">

        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-primary" <?php
        if (strlen($name) <= 2 || strlen($email) <= 8 || strlen($password) <= 7) {
            echo 'disabled';
        }
        ?>>{{ __('Insert') }}</button>
    </div>
</form>
