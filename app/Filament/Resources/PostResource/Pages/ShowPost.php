<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Models\Post;
use Filament\Resources\Pages\Page;
use App\Filament\Resources\PostResource;

class ShowPost extends Page
{
    protected static string $resource = PostResource::class;

    protected static string $view = 'filament.resources.post-resource.pages.show-post';

    public function getData()
    {
        $id = request()->segment(4);

        $result = Post::whereSlug($id)->first();

        return $result;
    }
}
