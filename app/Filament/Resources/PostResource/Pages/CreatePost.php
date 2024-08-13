<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Models\User;
use App\Notifications\PostCreated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\PostResource;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function getRedirectUrl(): string
    {
        $this->afterSave();
            
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function afterSave(){
        $user = Auth::user();

        Notification::make()
        ->success()
            ->title("Post created by {$user->name}")
            ->body('Changes to the post have been saved.')
            ->actions([
                Action::make('view')
                    ->button()
                    ->url('admin/posts/show/'.$this->record->slug, shouldOpenInNewTab: true)
                    ->markAsRead(),
                Action::make('undo')
                    ->color('gray')
                    ->close(),
            ])
            ->sendToDatabase(User::whereNot('id', $user->id)->get());
    }

}
