

<x-filament-panels::page>
        @php
    
            $data = $this->getUser();

            // echo $data;
        @endphp
    <x-filament::card>
        <div>
            {{ $data['name'] }}
        </div>
        <ul>
            <li>Nama : {{ $data['name'] }} </li>
            <li>Role : {{ $data['roles'][0]['name'] }}</li>
        </ul>
       
    </x-filament::card>
</x-filament-panels::page>
