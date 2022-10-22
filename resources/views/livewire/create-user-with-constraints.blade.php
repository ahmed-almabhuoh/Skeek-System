<form class="form-horizontal" method="POST" action="{{ route('super.user_store') }}">
    @csrf
    <div class="card-body">
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">{{ __('Full name') }}</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}"
                    placeholder="{{ __('Enter user full name') }}" style="@error('name') border-color: red; @enderror"
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
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}"
                    style="@error('email') border-color: red; @enderror" placeholder="{{ __('Enter user email') }}"
                    wire:model="email">
                @error('email')
                    <SMAll style="color: red">
                        {{ $message }}
                    </SMAll>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">{{ __('Password') }}</label>
            <div class="col-sm-10">
                <input type="text" name="password" class="form-control" id="password" wire:model="password"
                    style="@error('password') border-color: red; @enderror"
                    placeholder="{{ __('Enter user password') }}" value="{{ $password }}">
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
                    <input type="checkbox" class="form-check-input" id="password_generator" name="password_generator"
                        wire:model="usePasswordGenerator">
                    <label class="form-check-label" for="password_generator">{{ __('Use password generator') }}</label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="active" name="active" checked>
                    <label class="form-check-label" for="active">{{ __('is Active!') }}</label>
                </div>
            </div>
        </div>

    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-info" <?php
        if (strlen($password) <= 7 || strlen($email) <= 8 || strlen($name) <= 2) {
            echo 'disabled';
        }
        ?>>{{ __('Create') }}</button>
        <button type="reset" class="btn btn-default float-right">{{ __('Cancel') }}</button>
    </div>
    <!-- /.card-footer -->
</form>
