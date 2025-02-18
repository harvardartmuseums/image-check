<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
@php
$record = $getRecord();
@endphp

    <div class="grid grid-cols-2 gap-4">
        <div>
            <h3 class="text-lg font-medium mb-2">DYNMC Image</h3>
            @if($record->BaseImageURL)
                <img src="{{ $record->BaseImageURL }}:IMAGE/full/!400,400/0/default.jpg"
                    alt="DYNMC Image"
                    class="max-w-full h-auto rounded shadow-lg">
            @else
                <p class="text-gray-500">No DYNMC image available</p>
            @endif
        </div>
        <div>
            <h3 class="text-lg font-medium mb-2">PRDWORK Image</h3>
            @if($record->PRDWORK_BaseImageURL)
                <img src="{{ $record->PRDWORK_BaseImageURL }}:IMAGE/full/!400,400/0/default.jpg"
                    alt="PRDWORK Image"
                    class="max-w-full h-auto rounded shadow-lg">
            @else
                <p class="text-gray-500">No PRDWORK image available</p>
            @endif
        </div>
    </div>
</x-dynamic-component>
