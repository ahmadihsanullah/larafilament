@php
    $data = $this->getData();
@endphp
<x-filament-panels::page>
    <x-filament::card>
        <div class="container">
            <p class="p-2">{{ $data->title }}</p>
            <hr>
            <div class="mt-4 p-2 rounded-2xl">
                <p class="font-family">
                    {!!$data->content!!}
                </p>
            </div>
        </div>
    </x-filament::card>
</x-filament-panels::page>