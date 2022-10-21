<form action="{{ route('super.super_store') }}" method="POST">
    @csrf
    <div class="modal-body">
        {{-- <p>After you add this static country with <strong>active status</strong>, it'll be
            <strong>usable</strong> for all users in systems&hellip;
        </p> --}}
        <div class="form-group">

            <label for="name">{{ __('Supor fullname') }}</label>
            <input type="text" class="form-control @error('name')
                is-invalid
            @enderror"
                id="name" name="name" placeholder="{{ __('Enter country name') }}" value="{{ old('name') }}"
                wire:model="name">
            @error('name')
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('With role') }}</label>
            <select class="form-control @error('role_id')
                is-invalid
            @enderror"
                name="role_id" id="role_id" wire:model="role_id">
                <option value="0">*
                </option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role_id')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">

            <label for="email">{{ __('Supor email') }}</label>
            <input type="email"
                class="form-control @error('email')
                is-invalid
            @enderror @if ($emailIsExists) is-invalid @endif"
                id="email" name="email" wire:model="email" placeholder="{{ __('Enter super email') }}"
                value="{{ old('email') }}">
            @error('email')
                <small style="color:red">{{ $message }}</small>
            @enderror
            @if ($emailIsExists)
                <small style="color:red">{{ __('Email you are selected is used before') }}</small>
            @endif
        </div>

        <div class="form-group">

            <label for="password">{{ __('Supor password') }}</label>
            <input type="text"
                class="form-control @error('password')
                is-invalid
            @enderror" id="password"
                name="password" wire:model="super_password" placeholder="{{ __('Enter super password') }}"
                value="{{ $super_password }}">
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
                    <input class="custom-control-input" type="checkbox" id="active" name="active">
                    <label for="active" class="custom-control-label">{{ __('Active ?!') }}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer justify-content-between">

        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-primary" <?php
        if (strlen($name) <= 3 || $role_id == 0 || strlen($email) <= 8 || strlen($super_password) <= 7 || $emailIsExists) {
            echo 'disabled';
        }
        ?>>{{ __('Inserts') }}</button>
    </div>
</form>
