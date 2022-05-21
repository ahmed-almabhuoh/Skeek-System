<div>
    {{-- Stop trying to control. --}}
    <input type="text" wire:model="searchTerm" />

    @if (!is_null($searchTerm))
        <ul>
            @foreach ($sheeks as $sheek)
                <li>
                    <a href="{{route('sheeks.edit', $sheek->id)}}">{{ $sheek->beneficiary_name }}</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
