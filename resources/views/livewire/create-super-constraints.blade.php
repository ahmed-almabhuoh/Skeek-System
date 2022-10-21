<form class="form-horizontal" method="POST" action="{{ route('super.super_store') }}">
    @csrf
    <div class="card-body">
        <div class="form-group row">
            <label for="role_id" class="col-sm-2 col-form-label">{{ __('Role name') }}</label>
            <div class="col-sm-10">
                <select class="form-control @error('role_id')
                    is-invalid
                @enderror"
                    name="role_id" wire:model="role_id">
                    <option value="0">*</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role_id')
                    <SMAll style="color: red">
                        {{ $message }}
                    </SMAll>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">{{ __('Full name') }}</label>
            <div class="col-sm-10">
                <input type="text" name="name"
                    class="form-control @error('name')
                    is-invalid
                @enderror"
                    id="name" value="{{ old('name') }}" placeholder="{{ __('Enter super full name') }}"
                    wire:model="name">
                @error('name')
                    <SMAll style="color: red">
                        {{ $message }}
                    </SMAll>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
            <div class="col-sm-10">
                <input type="email" name="email"
                    class="form-control @error('email')
                    is-invalid
                @enderror
                    @if ($emailIsExists) is-invalid @endif
                "
                    id="email" value="{{ old('email') }}" placeholder="{{ __('Enter super email') }}"
                    wire:model="email">
                @error('email')
                    <SMAll style="color: red">
                        {{ $message }}
                    </SMAll>
                @enderror
                @if ($emailIsExists)
                    <SMAll style="color: red">
                        {{__('Email you are entered is already used before.')}}
                    </SMAll>
                @endif
            </div>
        </div>


        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">{{ __('Password') }}</label>
            <div class="col-sm-10">
                <input type="text" name="password"
                    class="form-control @error('password')
                    is-invalid
                @enderror"
                    id="password" placeholder="{{ __('Enter super password') }}" value="{{ $password }}">
                @error('password')
                    <SMAll style="color: red">
                        {{ $message }}
                    </SMAll>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="password_generator"
                        wire:model="usePasswordGenerator">
                    <label class="form-check-label"
                        for="password_generator">{{ __('User password generator automatically') }}</label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="active" checked>
                    <label class="form-check-label" for="active">{{ __('is Active!') }}</label>
                </div>
            </div>
        </div>

    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-info" <?php
        if (strlen($name) <= 3 || strlen($email) <= 8 || $role_id == 0 || strlen($password) <= 7 || $emailIsExists) {
            echo 'disabled';
        }
        ?>>{{ __('Create') }}</button>
        <button type="reset" class="btn btn-default float-right">{{ __('Cancel') }}</button>
    </div>
    <!-- /.card-footer -->
</form>
