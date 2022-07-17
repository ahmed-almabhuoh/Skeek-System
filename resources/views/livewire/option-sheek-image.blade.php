<div>
    {{-- Do your work, then step back. --}}
    <div>
        <div class="container mx-auto">
            <button type="button" wire:click="$toggle('showFileElement')" class="px-4 py-2 text-purple-100 bg-purple-500">Upload New
                Image
            </button>
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
