# CDN
Om het associëren van afbeeldingen (en andere media) met verschillende models
gemakkelijk te maken, gebruiken we de package [spatie/laravel-medialibrary](https://github.com/spatie/laravel-medialibrary/tree/main).


Deze package zorgt ervoor dat je gemakkelijk afbeeldingen kunt uploaden en deze kan
toevoegen aan een model.

### Requirements
- laravel/framework ^10.0   
- spatie/laravel-medialibrary ^11.0

## Documentatie
Zie https://spatie.be/docs/laravel-medialibrary/v11/introduction voor de originele documentatie.

## Installatie
Installeer via composer:
```
composer require "spatie/laravel-medialibrary:^11.0.0"
```

Publish de migrations:
```
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"
```

Publish de config
```
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="config"
```

Voer de migrations uit:
```
php artisan migrate
```

### Filesystem
Indien gewenst maak je een nieuwe disk aan in `config/filesystems.php` en vul
de gegevens in om toegang te krijgen tot deze disk. Op deze manier kun je de afbeeldingen
automatisch laten uploaden naar een externe opslag zoals S3, Google Cloud Storage of via FTP.

Voor het gemak gebruiken we hier de `public` disk, deze is default. Mocht je een andere disk
willen gebruiken, dan kun je deze aanpassen in je .env-file door de `MEDIA_DISK`-key in te stellen
op de naam van de disk.

```php
'public' => [
    'driver' => 'local',
    'root' => storage_path('app/public'),
    'url' => env('APP_URL').'/storage',
    'visibility' => 'public',
    'throw' => false,
]
```

### Model
Implementeer de `HasMedia`-interface en voeg de `InteractsWithMedia`-trait toe aan het model waar je media aan wilt toevoegen:

```php
class Home extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
}
```

### Collections en conversions
Met de volgende code in de model geef je aan welke collecties 
er bestaan.

```php
/**
 * Register the media collections.
 *
 * @return void
 */
public function registerMediaCollections(): void
{
    // Collectie `main` is een enkele afbeelding
    $this->addMediaCollection('main')
        ->singleFile();

    // Collectie `gallery` is een verzameling afbeeldingen
    $this->addMediaCollection('gallery');
}
```

Geef vervolgens aan welke conversies er bestaan voor de collecties:

```php
public function registerMediaConversions(Media $media = null): void
{
    // Deze conversie wordt toegepast op de collectie `main` en `gallery`.
    // De afbeelding wordt omgezet naar het webp formaat en de afmetingen
    // worden aangepast naar 400x300.
    $this->addMediaConversion('thumbnail')
        ->performOnCollections('main', 'gallery')
        ->format('webp')
        ->width(400)
        ->height(300);
    
    // Deze conversie wordt toegepast op de collectie `main` en `gallery`.
    // De afbeelding wordt omgezet naar het webp formaat en de afmetingen
    // worden aangepast naar 1024x768.
    $this->addMediaConversion('full')
        ->performOnCollections('main', 'gallery')
        ->format('webp')
        ->width(1024)
        ->height(768);
}
```

### Afbeeldingen toevoegen
Om een afbeelding toe te voegen aan een model, gebruik je de `addMediaFromRequest`-methode:

```php
public function store(Request $request)
{
    $home = Home::create($request->all());

    $home->addMediaFromRequest('image')->toMediaCollection('main');

    return redirect()->route('home.index');
}
```

Ook kun je meerdere afbeeldingen tegelijk toevoegen:

```php
public function store(Request $request)
{
    $home = Home::create($request->all());

    $home->addMediaFromRequest('images')->toMediaCollection('gallery');

    return redirect()->route('home.index');
}
```

Of je kunt een afbeelding toevoegen vanuit een URL:

```php
public function store(Request $request)
{
    $home = Home::create($request->all());

    $home->addMediaFromUrl('https://example.com/image.jpg')->toMediaCollection('main');

    return redirect()->route('home.index');
}
```


### Afbeeldingen ophalen
Om een enkele afbeelding op te halen, gebruik je de `getFirstMediaUrl`-methode.
Hierin geef je aan uit welke collectie en welke conversie je de afbeelding wilt ophalen:

```php
<img src="{{ $home->getFirstMediaUrl('main', 'thumbnail') }}" alt="">
```

Om alle afbeeldingen op te halen, gebruik je de `getMedia`-methode:
```php
@foreach($home->getMedia('gallery') as $image)
    <img src="{{ $image->getUrl('thumbnail') }}" alt="">
@endforeach
```