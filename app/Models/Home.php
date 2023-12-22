<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Home extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'subtitle',
        'description',
        'price'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = [
        'price' => 'double',
    ];

    /**
     * Register the media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main')
            ->singleFile();

        $this->addMediaCollection('gallery');
    }

    /**
     * Register the media conversions.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @return void
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->performOnCollections('main', 'gallery')
            ->format('webp')
            ->width(400)
            ->height(300);

        $this->addMediaConversion('full')
            ->performOnCollections('main', 'gallery')
            ->format('webp')
            ->width(1024)
            ->height(768);

        $this->addMediaConversion('test')
            ->performOnCollections('main', 'gallery')
            ->format('webp')
            ->width(100)
            ->height(100);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected function city(): BelongsTo
    {
        $this->belongsTo(City::class);
    }
}
