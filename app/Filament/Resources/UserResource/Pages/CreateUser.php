<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Textarea;
use App\Filament\Resources\UserResource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Notifications\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{

    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = UserResource::class;

    protected function getSteps(): array
    {

        return  [
            Wizard\Step::make('Register')
                ->icon('heroicon-o-key')
                ->schema([
                    Card::make()
                        ->schema([
                            TextInput::make('name')
                                ->label('Name')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->required()
                                ->maxLength(255),

                            Grid::make(2)
                                ->schema([
                                    TextInput::make('password')
                                        ->label('Password')
                                        ->password()
                                        ->dehydrateStateUsing(fn($state) => !empty($state) ? bcrypt($state) : null)
                                        ->maxLength(255)
                                        ->same('password_confirmation')
                                        ->required(),

                                    TextInput::make('password_confirmation')
                                        ->label('Confirm Password')
                                        ->password()
                                        ->required(fn($livewire) => $livewire instanceof CreateUser)
                                        ->maxLength(255)
                                        ->dehydrated(false),
                                ]),
                            Select::make('role')
                                ->relationship('roles', 'name')
                                ->multiple()
                                ->preload()   
                                ->createOptionForm([
                                    TextInput::make('name')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                ])

                        ]),
                ]),
            Wizard\Step::make('Profile')
                ->icon('heroicon-o-user')
                ->schema([
                    TextInput::make('birth')
                        ->type('date'),
                    Select::make('gender')
                        ->options([
                            'Male' => 'Male',
                            'Female' => 'Female'
                        ]),
                    Textarea::make('address')
                        ->label('Address')
                        ->columnSpan(2)
                ])->columns(2),
            Wizard\Step::make('Biodata')
                ->icon('heroicon-o-pencil')
                ->schema([
                    Textarea::make('biodata')
                        ->label('Biodata')
                        ->rows(6)
                ]),


        ];
    }
}
