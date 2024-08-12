<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model implements HasMedia
{
    use HasFactory;

    use InteractsWithMedia;

    protected $fillable = ['category_id','title', 'slug', 'content', 'status'];

    public function category():BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany{
        return $this->belongsToMany(Tag::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('covers')
             ->useDisk('public')
             ->useFallbackUrl('/path/to/default/image.jpg')
             ->singleFile(); // jika hanya ingin menyimpan satu file per model
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(368)
              ->height(232)
              ->sharpen(10);
    }

    public function addCover($file)
    {
        $folderName = '/storage/covers'; // Bisa diubah sesuai kebutuhan

        $this->addMedia($file)
            ->usingFileName(Str::slug($this->title) . '.' . $file->getClientOriginalExtension())
            ->toMediaCollection('covers', 'public');
    }
}
