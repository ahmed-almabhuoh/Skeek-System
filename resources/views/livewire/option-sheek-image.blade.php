<div>
    {{-- Do your work, then step back. --}}
    <div>
        {{-- Start --}}
        <h6>Upload Sheek Image</h6>

        <label class="switch">
            <input type="checkbox" wire:click="$toggle('showFileElement')">
            <span class="slider round"></span>
        </label>
        {{-- End --}}
        <div class="container mx-auto">
            @if ($showFileElement)
                <div class="form-group">
                    <label for="sheek_image">{{ __('cms.image') }}</label>
                    @error('sheek_image')
                        <p class="text-danger" style="display: inline-block; padding: 0 0 0 10px;">
                            {{ $message }}</p>
                    @enderror
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="sheek_image" name="sheek_image">
                            <label class="custom-file-label"
                                for="sheek_image">{{ __('cms.select_sheek_image') }}</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">{{ __('cms.upload') }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
