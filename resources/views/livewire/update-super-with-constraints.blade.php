<form class="form-horizontal" method="POST" action="{{ route('super.super_update', Crypt::encrypt($super->id)) }}">
    @csrf
    @method('PUT')
    <div class="card-body">
        <div class="form-group row" style="display: none;">
            <input type="text" name="id" class="form-control" id="id"
                value="{{ Crypt::encrypt($super->id) }}" placeholder="{{ __('Enter super id') }}">
        </div>

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">{{ __('Full name') }}</label>
            <div class="col-sm-10">
                <input type="text" name="name"
                    class="form-control @error('name')
                    is-invalid
                @enderror"
                    id="name" value="{{ $super->name }}" placeholder="{{ __('Enter super full name') }}">
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
                @enderror"
                    id="email" value="{{ $super->email }}" placeholder="{{ __('Enter super email') }}"
                    >
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
                <input type="text" name="password"
                    class="form-control @error('password')
                    is-invalid
                @enderror"
                    id="password" placeholder="{{ __('Enter super password') }}" value="{{ $password }}">
                <small>{{ __('If won\'t change the super password, let it empty.') }}</small>
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
                        wire:model="userPasswordGeneration">
                    <label class="form-check-label" for="password_generator">{{ __('Use password generator') }}</label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="active" name="active"
                        @if ($super->active) checked @endif>
                    <label class="form-check-label" for="active">{{ __('is Active!') }}</label>
                </div>
            </div>
        </div>

    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-info">{{ __('Update') }}</button>
        <button type="reset" class="btn btn-default float-right">{{ __('Cancel') }}</button>
    </div>
    <!-- /.card-footer -->
</form>
