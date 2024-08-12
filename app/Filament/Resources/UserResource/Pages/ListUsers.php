<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use App\Filament\Resources\UserResource;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Route;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ButtonAction::make('Laporan pdf')->url(fn () => route('download.tes'))->openUrlInNewTab(),
            Actions\CreateAction::make(),
        ];
    }
}
