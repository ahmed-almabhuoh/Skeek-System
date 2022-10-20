<form method="POST" action="{{ route('countries.static_store') }}">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" wire:model="country_name"
                class="form-control @error('name')
                is-invalid
            @enderror" id="name"
                name="name" placeholder="{{ __('Enter country name') }}" value="{{ old('name') }}"
                wire:model="country_name">
            <small>{{ __('The country name should have at least three letters') }}</small>
            @error('name')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="active" name="active" checked>
            <label class="form-check-label" for="active">{{ __('Active') }}</label>
            @error('active')
                <p class="text-danger" style="display: inline-block; padding: 0 0 0 10px;">
                    {{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="card-footer">
        <input type="submit" value="{{ __('Create') }}" class="btn btn-primary" <?php
        if (empty($country_name)) {
            echo 'disabled';
        } elseif (strlen($country_name) <= 2) {
            echo 'disabled';
        }
        ?>>
    </div>

</form>
