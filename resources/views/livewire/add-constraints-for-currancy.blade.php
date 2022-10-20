<form id="create-form" method="POST" action="{{ route('currancies.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="name">{{ __('Currancy') }}</label>
            @error('name')
                <span style="margin-left: 15px;diplay: block; color: red;">
                    {{ $message }}
                </span>
            @enderror
            <input type="text" name="name" class="form-control" id="name" wire:model="name"
                placeholder="{{ __('Enter currancy name') }}" value="{{ old('name') }}">
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

        <input type="submit" value="{{ __('Create') }}" class="btn btn-primary" <?php
        if (strlen($name) <= 1) {
            echo 'disabled';
        }
        ?>>
    </div>
</form>
