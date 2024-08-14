<?php

namespace App\Livewire;

use Nette\Utils\Html;
use Livewire\Component;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Actions\Action;
 use Filament\Forms\Concerns\InteractsWithForms;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Models\User;
use Illuminate\View\View;

class Form extends Component implements HasForms
{
    use InteractsWithForms;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $birth;
    public $gender;
    public $address;
    public $biodata;

    public function mount()
    {
        $this->form->fill([]);
    }

    protected function getFormSchema(): array
    {
        return  [
            Wizard::make([
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
            ])->submitAction(
                Action::make('submit')
                ->label('Submit Form')
                ->color('primary')
                ->icon('heroicon-o-paper-airplane')
                ->action('submit') 
            ),

        ];
    }

    public function render()
    {
        return view('livewire.form');
    }

    public function submit()
    {
        $data = $this->form->getState();

        // Proses data form
        User::create($data);

        // Reset form
        $this->form->fill();

        // Redirect jika diperlukan
        return redirect()->to('/completed');
    }

    public function completed(): View
    {
        return View('livewire.completed');
    }

}
